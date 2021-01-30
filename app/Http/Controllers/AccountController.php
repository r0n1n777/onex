<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;
use App\Models\User;
use App\Models\Account;
use App\Models\PayoutOptions;
use App\Models\Payouts;
use Redirect;
use Home;
use Auth;

class AccountController extends Controller
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
    public function profile()
    {
        $user = Auth::user();
        $path = (new HomeController)->getProfilePicture($user->id, $user->gender);
        return view('pages.account.profile')->with('user', $user)
                                            ->with('path', $path);
    }

    public function payout()
    {
        $user = Auth::user();
        $path = (new HomeController)->getProfilePicture($user->id, $user->gender);
        $balanceEarnings = (new PayoutController)->getBalance($user->id);
        $payoutOptions = PayoutOptions::where('uid', $user->id)->get();
        $payouts = Payouts::where('uid', $user->id)->with('payoutOption')->orderBy('id', 'desc')->get();
        return view('pages.account.payout')->with('user', $user)
                                            ->with('path', $path)
                                            ->with('balance', $balanceEarnings->balance)
                                            ->with('earnings', $balanceEarnings->earnings)
                                            ->with('payoutOptions', $payoutOptions)
                                            ->with('payouts', $payouts);
    }

    public function security()
    {
        $user = Auth::user();
        $path = (new HomeController)->getProfilePicture($user->id, $user->gender);
        return view('pages.account.security')->with('user', $user)
                                            ->with('path', $path);
    }

    public function uploadProfilePicture(Request $request)
    {
        $user = Auth::user();

        $data = $request->image;
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);

        $data = base64_decode($data);
        $image_name = $user->id.'.png';
        $path = public_path() . '/assets/img/dp/' . $image_name;
        file_put_contents($path, $data);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'fname' => ['required', 'alpha', 'max:50', 'min:2'],
            'lname' => ['required', 'alpha', 'max:50', 'min:2'],
            'gender' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(Auth::user()->id) ],
        ],
        [
            'fname.required' => 'Please enter your first name.',
            'fname.alpha' => 'Your first name should not have a number.',
            'fname.max' => 'Your first name is too long.',
            'fname.min' => 'Your first name is too short.',
            'lname.required' => 'Please enter your last name.',
            'lname.alpha' => 'Your last name should not have a number.',
            'lname.max' => 'Your last name is too long.',
            'lname.min' => 'Your last name is too short.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'Your email address is too long.',
            'email.unique' => 'Your email address is already in use.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('profile')
                        ->withErrors($validator)
                        ->withInput();
        }

        $user = Account::find(Auth::user()->id);

        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->save();

        return redirect()->back();
    }

    public function addPayout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payout' => ['required'],
            'number' => ['required', 'max:50'],
            'name' => ['required', 'max:50'],
        ],
        [
            'payout.required' => 'Please select a payout option.',
            'number.required' => 'Please enter your account number for your chosen outlet.',
            'number.max' => 'Your account number is too long.',
            'name.required' => 'Please enter your name associated with your account for your chosen outlet.',
            'name.max' => 'Your account name is too long.',
        ]);

        if ($validator->fails()) {
            $validator->errors()->add('add-payout', 'Error in Adding Payout Option');
            return redirect()->route('payout')
                        ->withErrors($validator)
                        ->withInput();
        }

        $payout = new PayoutOptions;

        $payout->uid = Auth::user()->id;
        $payout->payout = $request->payout;
        $payout->number = $request->number;
        $payout->name = $request->name;
        
        $payout->save();

        return redirect()->back();
    }

    public function deletePayout(Request $request)
    {
        $payout = PayoutOptions::find($request->id);

        $payout->delete();

        return redirect()->back();
    }

    public function requestPayout(Request $request)
    {
        $balanceEarnings = (new PayoutController)->getBalance(Auth::user()->id);
        $validator = Validator::make($request->all(), [
            'amount' => ['required', 'numeric', 'lte:'.$balanceEarnings->balance, 'min:500'],
        ],
        [
            'amount.required' => 'Please enter an amount.',
            'amount.numeric' => 'The amount must be a number.',
            'amount.lte' => 'You don\'t have enough balance.',
            'amount.min' => 'You can only request a payout for a minimum amount of 500.',
        ]);

        $checkPendingRequest = (new PayoutController)->checkPendingRequest(Auth::user()->id);
        if ($checkPendingRequest == true){
            $validator->errors()->add('request-payout', 'Error in Requesting Payout');
            $validator->errors()->add('amount', 'You still have a pending payout request. You can try again once the current request is approved.');
            return redirect()->route('payout')->withErrors($validator)
                                        ->withInput();
        }

        if ($validator->fails()){
            $validator->errors()->add('request-payout', 'Error in Requesting Payout');
            return redirect()->route('payout')->withErrors($validator)
                                        ->withInput();
        }

        $payout = new Payouts;

        $payout->uid = Auth::user()->id;
        $payout->pid = $request->pid;
        $payout->amount = $request->amount;

        $payout->save();

        return redirect()->back();
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'currentpassword' => ['required'],
            'password' => ['required', 'min:8', 'max:25', 'same:password'],
            'passwordconfirm' => ['required', 'same:password'],
        ],
        [
            'currentpassword.required' => 'Please enter your current password.',
            'password.required' => 'Please enter your new password.',
            'password.min' => 'Password should be at least 8 characters long.',
            'password.max' => 'Password should not be more than 25 characters long.',
            'password.same' => 'New passwords does not match',
            'passwordconfirm.required' => 'Please enter the password confirmation.',
            'passwordconfirm.same' => 'New passwords does not match',
        ]);

        if ($validator->fails()){
            return redirect()->route('security')->withErrors($validator)
                                        ->withInput();
        }

        if (!Hash::check($request->currentpassword, Auth::user()->password)){
            $error = new MessageBag();
            $error->add('currentpassword', 'You entered an incorrect password.');

            return redirect()->route('security')->withErrors($error)
                                        ->withInput();
        }

        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($request->password);
        $user->save();

        Auth::logout();

        return view('auth.login')->with('passwordchanged', 'You have successfully changed your password, please login again.');
    }
}
