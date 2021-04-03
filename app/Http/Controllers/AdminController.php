<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use User;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth'); 
    }

    public function show() {

        $user = Auth::user();
        $path = (new HomeController)->getProfilePicture($user->id, $user->gender);
        $accounts = User::orderBy('created_at', 'desc')->get();
        $activeCount = count(User::where('activated', 1)->get());
        $pendingCount = count(User::where('activated', 0)->get());

        if ($user->admin == false) {
            return redirect('/home');
        }

        return view('pages.admin')->with('user', $user)
                                ->with('path', $path)
                                ->with('accounts', $accounts)
                                ->with('activeCount', $activeCount)
                                ->with('pendingCount', $pendingCount);
    }

    public function activate(Request $request) {
        $auser = User::find($request->id);

        if ($auser->activated == true) {
            $auser->activated = false;
        }
        else {
            $auser->activated = true;
        }
        
        $auser->save();

        return redirect()->back()->with('result', $auser);
    }
}
