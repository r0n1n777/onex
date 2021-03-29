<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Auth;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth'); 
    }

    public function show() {

        $user = Auth::user();
        $path = (new HomeController)->getProfilePicture($user->id, $user->gender);
        $pendingAccounts = Admin::where('activated', 0)->get();

        if ($user->admin == false) {
            return redirect('/home');
        }

        return view('pages.admin')->with('user', $user)
                                ->with('path', $path)
                                ->with('pendingAccounts', $pendingAccounts);
    }
}
