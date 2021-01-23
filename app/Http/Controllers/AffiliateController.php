<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Affiliates;
use Auth;

class AffiliateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        $user = Auth::user();
        $affiliates = (object) (new HomeController)->getInvites($user->id, 'all');
        $path = (new HomeController)->checkDP($user->id, $user->gender);

        return view('pages.affiliates')->with('path', $path)
                                    ->with('user', $user)
                                    ->with('affiliates', $affiliates);
    }
}
