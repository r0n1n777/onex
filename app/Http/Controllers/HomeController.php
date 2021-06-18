<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Payouts;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $path = $this->getProfilePicture($user->id, $user->gender);
        $data = $this->dashboard($user->id);

        return view('pages.home')->with('user', $user)
                                ->with('path', $path)
                                ->with('data', $data);
    }

    public function getProfilePicture($id, $gender)
    {
        // CHECK IF PROFILE PICTURE EXISTS
        $dp = file_exists('assets/img/dp/'.$id.'.png');
        if ($dp == true){
            return 'assets/img/dp/'.$id.'.png';
        }
        else {
            return 'assets/img/dp/'.$gender.'.png';
        }
    }

    public function getInvites($id, $condition)
    {
        if ($condition == 'all'){
            $users = User::where('referrer_id', $id)->get();
        }
        elseif ($condition == 'activated'){
            $users = User::where('referrer_id', $id)->where('activated', true)->get();
        }
        elseif ($condition == 'pending'){
            $users = User::where('referrer_id', $id)->where('activated', false)->get();
        }
        $data = array();
        foreach ($users as $k => $v){
            $path = $this->getProfilePicture($v->id, $v->gender);
            $tier = $this->tier($v->id);

            $n = $v;
            $n['path'] = $path;
            $n['tierLevel'] = $tier->tierLevel;
            $n['tierTitle'] = $tier->tierTitle;
            $data[$k] = $n;
        }
        return $data;
    }

    public function getRegularInvites($id)
    {
        // GET ALL DIRECT INVITES THAT ARE REGULAR
        $regularDirectInvites = array();
        $unfilteredRegularDirectInvites = User::where('referrer_id', $id)->where('activated', true)->get()->toArray();
        foreach ($unfilteredRegularDirectInvites as $member) {
            $q = $this->getInvites($member['id'], 'activated');
            if (count($q) >= 5) {
                if ($member['binary_referrer_id'] == null) {
                    array_push($regularDirectInvites, $member);
                }
            }
        }

        return $regularDirectInvites;
    }

    public function dashboard($id)
    {

        // GET TIER OF AUTH USER
        $tier = $this->tier($id);

        // GET ONLY ACTIVE MEMBERS
        $directInvites = $this->tier($id)->directInvites;

        // GET ONLY PENDING MEMBERS
        $directInvitesPending = $this->tier($id)->directInvitesPending;

        // GET ALL ACTIVE AND PENDING MEMBERS                        
        //$allInvites = $this->tier($id)->allInvites;

        // GET EARNINGS AND BALANCE INFO
        $payout = (new PayoutController)->getEarningsBalance($id);

        $data = array(  'tierLevel' => $tier->tierLevel,
                        'tierTitle' => $tier->tierTitle,
                        'directInvites' => $directInvites,
                        'directInvitesPending' => $directInvitesPending,
                        'numDirectInvites' => $tier->numDirectInvites,
                        'numDirectInvitesPending' => $tier->numDirectInvitesPending,
                        'earnings' => $payout->earnings,
                        'balance' => $payout->balance);
        $data = (object) $data;

        return $data;

    }

    public function tier($id) 
    {

        //$allInvites = $this->getInvites($id, 'all'); // GET ALL INVITES (ACTIVE AND PENDING)
        $directInvites = $this->getInvites($id, 'activated'); // GET ALL ACTIVE DIRECT INVITES OF THE USER WITH id = $id
        $directInvitesPending = $this->getInvites($id, 'pending'); // GET ALL PENDING DIRECT INVITES OF THE USER WITH id = $id
        //$allInvitesBag = array('DirectInvites' => $directInvites, 'IndirectInvites' => array()); // SET ARRAY FOR DIRECT AND INDIRECT INVITES

        $users = $directInvites;
        /*
        for ($x = 1; $x <= 15; $x++){
            foreach ($users as $u){
                $indirectInvites = $this->getInvites($u['id'], 'activated');

                if (count($indirectInvites)){
                    foreach ($indirectInvites as $data){
                        $users = $indirectInvites;
                        array_push($allInvitesBag['IndirectInvites'], $data);
                    }
                }
            }
        }
        
        $numAllInvites = count($allInvitesBag['DirectInvites']) + count($allInvitesBag['IndirectInvites']);;
        
        $numIndirectInvites = count($allInvitesBag['IndirectInvites']);
        
        */

        $numDirectInvites = count($directInvites);
        $numDirectInvitesPending = count($directInvitesPending);

        $tierLevel = 1;
        $tierTitle = "Probationary";

        if ($numDirectInvites >= 5){
            $tierLevel = 2;
            $tierTitle = "Regular";
        }

        return (object) array(
            'tierLevel' => $tierLevel, 
            'tierTitle' => $tierTitle,
            //'allInvites' => $allInvites,
            //'allInvitesBag' => $allInvitesBag,
            'directInvites' => $directInvites,
            'directInvitesPending' => $directInvitesPending,
            'numDirectInvites' => $numDirectInvites,
            //'numIndirectInvites' => $numIndirectInvites,
            'numDirectInvitesPending' => $numDirectInvitesPending
        );
    }
}
