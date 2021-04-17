<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payouts;

class PayoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function checkPendingRequest($id)
    {
        $payouts = Payouts::where('uid', $id)->where('status', false)->get();

        if (count($payouts)){
            return true;
        }
        else {
            return false;
        }
    }

    public function getEarningsBalance($id)
    {

        // SET INITIAL EARNINGS AND BALANCE
        $earnings = 0;
        $balance = 0;
        $totalpayout = 0;
        $additionalPayout = 0;

        // GET TIER LEVEL OF AUTH USER
        $tier = (new HomeController)->tier($id);

        // GET INVITES (ACTIVE) OF AUTH USER WITH THEIR TIER LEVEL
        $directInvites = $tier->directInvites;

        // COMPUTE EARNINGS
        $earnings = count($directInvites) * 100;

        // COMPUTE ADDITIONAL AMOUNT BASE ON NUMBER OF INVITES AFTER FIRST 5 DIRECT INVITES
        if (count($directInvites) >= 5){
            $additionalPayout = (count($directInvites) - 5) * 200;
        }

        // GET TIER LEVEL OF AUTH USER
        $tierLevel = $tier->tierLevel;

        /* LOOP THROUGH INVITES AND CHECK IF NEED TO ADD AMOUNT BASE ON TIER
        foreach ($directInvites as $invite){
            if ($invite->tierLevel >= $tierLevel){
                $earnings += $amount;
            }
        }*/

        // GET ALL THE PAYOUTS AND COMPUTE HOW MUCH TO SUBSTRACT FROM THE BALANCE
        $payouts = Payouts::where('uid', $id)->where('status', true)->get();
        foreach ($payouts as $payout){
            $totalpayout += $payout->amount;
        }

        $earnings += $additionalPayout;
        $balance = $earnings - $totalpayout;

        $data = (object) array('earnings' => max(number_format($earnings), 0), 'balance' => max(number_format($balance), 0));
        return $data;
    }
}
