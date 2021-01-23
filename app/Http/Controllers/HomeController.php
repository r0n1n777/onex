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
        $path = $this->checkDP($user->id, $user->gender);
        $data = $this->dashboard($user->id);

        return view('pages.home')->with('user', $user)
                                ->with('path', $path)
                                ->with('data', $data);
    }

    public function checkDP($id, $gender)
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
            $path = $this->checkDP($v->id, $v->gender);
            $tier = $this->tier($v->id);

            $n = $v;
            $n['path'] = $path;
            $n['tierLevel'] = $tier->tierLevel;
            $n['tierTitle'] = $tier->tierTitle;
            $data[$k] = $n;
        }
        return $data;
    }

    public function dashboard($id)
    {

        // GET TIER OF AUTH USER
        $tier = $this->tier($id);

        $directInvites = $this->tierInvites($id);

        // GET ALL ACTIVE AND PENDING INVITES AND PICTURES                        
        $allInvites = $this->getInvites($id, 'all');

        $payout = (new PayoutController)->getBalance($id);
        
        $data = array(  'tierLevel' => $tier->tierLevel,
                        'tierTitle' => $tier->tierTitle,
                        'directInvites' => $directInvites,
                        'allInvites' => $allInvites,
                        'numDirectInvites' => $tier->numDirectInvites,
                        'numIndirectInvites' => $tier->numIndirectInvites,
                        'numDirectInvitesPending' => $tier->numDirectInvitesPending,
                        'earnings' => $payout->earnings,
                        'balance' => $payout->balance);
        $data = (object) $data;

        return $data;

    }

    public function tier($id) 
    {

        $directInvites = $this->getInvites($id, 'activated'); // GET ALL ACTIVE DIRECT INVITES OF THE USER WITH id = $id
        $directInvitesPending = $this->getInvites($id, 'pending'); // GET ALL PENDING DIRECT INVITES OF THE USER WITH id = $id
        $allInvites = array('DirectInvites' => $directInvites, 'IndirectInvites' => array()); // SET ARRAY FOR DIRECT AND INDIRECT INVITES

        $users = $directInvites;
        
        for ($x = 1; $x <= 15; $x++){
            foreach ($users as $u){
                $indirectInvites = $this->getInvites($u['id'], 'activated');

                if (count($indirectInvites)){
                    foreach ($indirectInvites as $data){
                        $users = $indirectInvites;
                        array_push($allInvites['IndirectInvites'], $data);
                    }
                }
            }
        }
        
        $numAllInvites = count($allInvites['DirectInvites']) + count($allInvites['IndirectInvites']);;
        $numDirectInvites = count($allInvites['DirectInvites']);
        $numIndirectInvites = count($allInvites['IndirectInvites']);
        $numDirectInvitesPending = count($directInvitesPending);

        $tierLevel = 1;
        $tierTitle = "Private";

        if ($numDirectInvites >= 5){
            $tierLevel = 2;
            $tierTitle = "Private First Class";
            switch ($numAllInvites) {
                case $numAllInvites >= 25:
                    $tierLevel = 3;
                    $tierTitle = "Specialist";
                case $numAllInvites >= 125:
                    $tierLevel = 4;
                    $tierTitle = "Corporal";
                case $numAllInvites >= 625:
                    $tierLevel = 5;
                    $tierTitle = "Sergeant";
                case $numAllInvites >= 3125:
                    $tierLevel = 6;
                    $tierTitle = "Staff Sergeant";
                case $numAllInvites >= 15625:
                    $tierLevel = 7;
                    $tierTitle = "Sergeant First Class";
                case $numAllInvites >= 78125:
                    $tierLevel = 8;
                    $tierTitle = "Master Sergeant";
                case $numAllInvites >= 390625:
                    $tierLevel = 9;
                    $tierTitle = "First Sergeant";
                case $numAllInvites >= 1953125:
                    $tierLevel = 10;
                    $tierTitle = "Sergeant Major";
                case $numAllInvites >= 9765625:
                    $tierLevel = 11;
                    $tierTitle = "Command Sergeant Major";
                case $numAllInvites >= 48828125:
                    $tierLevel = 12;
                    $tierTitle = "Sergeant Major of ONEX";
                case $numAllInvites >= 244140625:
                    $tierLevel = 13;
                    $tierTitle = "Sergeant Major of ONEX";
                case $numAllInvites >= 1220703125:
                    $tierLevel = 14;
                    $tierTitle = "Sergeant Major of ONEX";
                case $numAllInvites >= 6103515625:
                    $tierLevel = 15;
                    $tierTitle = "Sergeant Major of ONEX";
            }
        }

        return (object) array(
            'tierLevel' => $tierLevel, 
            'tierTitle' => $tierTitle,
            'numDirectInvites' => $numDirectInvites,
            'numIndirectInvites' => $numIndirectInvites,
            'numDirectInvitesPending' => $numDirectInvitesPending
        );
    }

    public function tierInvites($id){

        // GET ALL ACTIVE INVITES PICTURE/TIER LEVEL/USER DATA
        $directInvites = $this->getInvites($id, 'activated');
        $data = array();
        foreach ($directInvites as $k => $v){
            $tierInvites = $this->tier($v->id);

            $n = $v;
            $n['tierLevel'] = $tierInvites->tierLevel;
            $n['tierTitle'] = $tierInvites->tierTitle;
            $data[$k] = $n;
        }                        

        return $data;
    }
}
