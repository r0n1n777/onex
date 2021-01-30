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
        $path = (new HomeController)->getProfilePicture($user->id, $user->gender);
        $tier = (new HomeController)->tier($user->id);
        $affiliates = $tier->allInvites;
        $allAffiliates = json_decode(json_encode($tier->allInvitesBag));

        return view('pages.affiliates')->with('path', $path)
                                    ->with('user', $user)
                                    ->with('tier', $tier)
                                    ->with('affiliates', $affiliates)
                                    ->with('allAffiliates', $allAffiliates);
    }
}
