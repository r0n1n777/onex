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

    public function getBalance($id)
    {

        // SET INITIAL EARNINGS AND BALANCE
        $earnings = 0;
        $balance = 0;
        $totalpayout = 0;
        $additionalPayout = 0;

        // GET TIER LEVEL OF AUTH USER
        $tier = (new HomeController)->tier($id);

        // GET INVITES (ACTIVE) OF AUTH USER WITH THEIR TIER LEVEL
        $directActiveInvites = (new HomeController)->tierInvites($id);

        // COMPUTE ADDITIONAL AMOUNT BASE ON NUMBER OF INVITES AFTER FIRST 5 DIRECT INVITES
        if (count($directActiveInvites) >= 5){
            $additionalPayout = (count($directActiveInvites) - 5) * 200;
        }

        // GET TIER LEVEL OF AUTH USER
        $tierLevel = $tier->tierLevel;

        // SET AMOUNT TO ADD TO BALANCE BASE ON INVITES' TIER
        $amount = 0;
        switch ($tierLevel){
            case 1: 
                $earnings = 0;
                $amount = 100;
                break;
            case 2:
                $earnings = 500;
                $amount = 100;
                break;
            case 3: 
                $earnings = 1000;
                $amount = 200;
                break;
            case 4:
                $earnings = 3000;
                $amount = 600;
                break;
            case 5: 
                $earnings = 5000;
                $amount = 1000;
                break;
            case 6: 
                $earnings = 7000;
                $amount = 1400;
                break;
            case 7: 
                $earnings = 9000;
                $amount = 1800;
                break;
            case 8: 
                $earnings = 11000;
                $amount = 2200;
                break;
            case 9:
                $earnings = 13000;
                $amount = 2600;
                break;
            case 10: 
                $earnings = 15000;
                $amount = 3000;
                break;
            case 11: 
                $earnings = 17000;
                $amount = 3400;
                break;
            case 12: 
                $earnings = 19000;
                $amount = 3800;
                break;
            case 13: 
                $earnings = 21000;
                $amount = 4200;
                break;
            case 14: 
                $earnings = 23000;
                $amount = 4600;
                break;
            case 15: 
                $earnings = 39000;
                $amount = 7800;
                break;
        }

        // LOOP THROUGH INVITES AND CHECK IF NEED TO ADD AMOUNT BASE ON TIER
        foreach ($directActiveInvites as $invite){
            if ($invite->tierLevel >= $tierLevel){
                $earnings += $amount;
            }
        }

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
