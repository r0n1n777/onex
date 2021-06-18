<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Binary;
use Auth;

class BinaryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function binary($id)
    {
        $users = User::all()->toArray();
        $binaryUser = User::where('id', $id)->get()->toArray();
        $path = (new HomeController)->getProfilePicture($id, $binaryUser[0]['gender']);
        $binaryUser[0]['path'] = $path;
        $binaryUsers = array('user' => $binaryUser, $id => array('left' => array('position' => 'left'), 'right' => array('position' => 'right')));
        $binaryUsersCount = 1;
        $tempId = array($id);

        foreach ($tempId as &$t) {
            $binaryUsers[$t] = array('left' => array('position' => 'left'), 'right' => array('position' => 'right'));
            foreach ($users as $u) {
                // FIND ALL USERS UNDER THE BINARY TREE
                if ($u['binary_referrer_id'] == $t){
                    array_push($tempId, $u['id']);
                    // GET PROFILE PICTURE OF EACH
                    $path = (new HomeController)->getProfilePicture($u['id'], $u['gender']);
                    $u['path'] = $path;
                    // ADD THEM TO THE ARRAY OF BINARY USERS
                    if ($u['binary_position'] == 'left') {
                        $binaryUsers[$t]['left'] = $u;
                        $binaryUsersCount++;
                    }
                    elseif ($u['binary_position'] == 'right') {
                        $binaryUsers[$t]['right'] = $u;
                        $binaryUsersCount++;
                    }
                }
            }
        }
        $binaryUsers['binaryUsersCount'] = $binaryUsersCount;

        return $binaryUsers;
    }

    public function binaryEarnings($id) 
    {
        $binary = $this->binary($id);
        $binaryLeft;
        $binaryRight;
        $added = 0;
        $pairs = 0;
        $total = 0;

        // GET ALL REGULAR MEMBERS ALREADY ADDED IN THE BINARY TREE BY THE AUTH USER
        foreach ($binary as $b) {
            if (is_array($b)){
                foreach ($b as $user) {
                    if (array_key_exists('id', $user)){
                        if ($user['referrer_id'] == $id){
                            $added++;
                        }
                    }
                }
            }
        }
        
        if (array_key_exists('id', $binary[$id]['left'])){
            $binaryLeft = $this->binary($binary[$id]['left']['id']);
            $leftCount = $binaryLeft['binaryUsersCount'];
        }
        else {
            $leftCount = 0;
        }
        
        if (array_key_exists('id', $binary[$id]['right'])){
            $binaryRight = $this->binary($binary[$id]['right']['id']);
            $rightCount = $binaryRight['binaryUsersCount'];
        }
        else {
            $rightCount = 0;
        }
        
        if ($leftCount <= $rightCount){
            $pairs = $leftCount;
        }
        else {
            $pairs = $rightCount;
        }

        $total = ($pairs * 300) + ($added * 100);

        return $total;
    }
    
    public function show($id = null)
    {
        $user = Auth::user();
        $path = (new HomeController)->getProfilePicture($user->id, $user->gender);
        $regularDirectInvites = (new HomeController)->getRegularInvites($user->id); // GET ALL REGULAR MEMBERS
        
        if ($id == null){
            $binary = $this->binary($user->id);
            $binaryId = $user->id;
        }
        else {
            $binary = $this->binary($id);
            $binaryId = $id;
        }

        $binaryEarnings = number_format($this->binaryEarnings($binaryId), 2);

        // GET NUMBER OF LEFTS AND RIGHTS
        $binaryUsersLeft = 0;
        $binaryUsersRight = 0;
        $binaryPairings = 0;

        if (array_key_exists('id', $binary[$binaryId]['left'])){
            $leftId = $binary[$binaryId]['left']['id'];
            $count = $this->binary($leftId);
            $binaryUsersLeft = $count['binaryUsersCount'];
        }

        if (array_key_exists('id', $binary[$binaryId]['right'])){
            $rightId = $binary[$binaryId]['right']['id'];
            $count = $this->binary($rightId);
            $binaryUsersRight = $count['binaryUsersCount'];
        }

        if ($binaryUsersLeft <= $binaryUsersRight){
            $binaryPairings = $binaryUsersLeft;
        }
        else {
            $binaryPairings = $binaryUsersRight;
        }

        return view('pages.binary')->with('path', $path)
                                    ->with('user', $user)
                                    ->with('binary', $binary)
                                    ->with('binaryId', $binaryId)
                                    ->with('binaryLeft', $binaryUsersLeft)
                                    ->with('binaryRight', $binaryUsersRight)
                                    ->with('binaryPairings', $binaryPairings)
                                    ->with('binaryEarnings', $binaryEarnings)
                                    ->with('regularDirectInvites', $regularDirectInvites);
    }

    public function add(Request $request)
    {

        $user = User::find($request->user_id);

        // CHECK IF A REGULAR MEMBER DEPENDING ON THE INVITES
        $invites = (new HomeController)->getInvites($request->user_id, 'activated');
        if (count($invites) >= 5){
            // CHECK IF ALREADY ADDED TO BINARY
            if ($user->binary_referrer_id == null){
                // CHECK IF THE POSITION EITHER LEFT OR RIGHT IS TAKEN
                $pos = User::where('binary_referrer_id', $request->referrer_id)->get();
                $taken = false;
                foreach ($pos as $p){
                    if ($p->binary_position == $request->position){
                        $taken = true;
                    }
                }
                if ($taken == false){
                    // ADD THE USER TO THE BINARY
                    $addToBinary = Binary::find($request->user_id);
                    $addToBinary->binary_referrer_id = $request->referrer_id;
                    $addToBinary->binary_position = $request->position;
                    $addToBinary->save();

                    return redirect()->back();
                }
                else {
                    return redirect()->back()->withErrors(['The position for this Binary is already taken, please choose another one.']);
                }
            }   
            else {
                return redirect()->back()->withErrors(['This Member is already in a Binary Tree.']);
            }
        }
        else {
            return redirect()->back()->withErrors(['This Member doesn\'t have a Regular Status yet. He/She can\'t be added to your Binary Tree.']);
        }
    }
}
