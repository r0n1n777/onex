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
        $accounts = Admin::all();
        $activeCount = count(Admin::where('activated', 1)->get());
        $pendingCount = count(Admin::where('activated', 0)->get());

        if ($user->admin == false) {
            return redirect('/home');
        }

        return view('pages.admin')->with('user', $user)
                                ->with('path', $path)
                                ->with('accounts', $accounts)
                                ->with('activeCount', $activeCount)
                                ->with('pendingCount', $pendingCount);
    }
}
