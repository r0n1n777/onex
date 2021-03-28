<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Binary;
use Auth;

class BinaryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        $user = Auth::user();
        $path = (new HomeController)->getProfilePicture($user->id, $user->gender);
        $tier = (new HomeController)->tier($user->id);
        $affiliates = $tier->directInvites;
        $affiliatesPending = $tier->directInvitesPending;

        return view('pages.binary')->with('path', $path)
                                    ->with('user', $user)
                                    ->with('tier', $tier)
                                    ->with('affiliates', $affiliates)
                                    ->with('affiliatesPending', $affiliatesPending);
    }
}
