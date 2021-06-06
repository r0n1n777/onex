<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'uname' => ['required', 'alpha_num', 'max:25', 'min:6', 'unique:users'],
            'fname' => ['required', 'alpha_spaces', 'max:50', 'min:2'],
            'lname' => ['required', 'alpha_spaces', 'max:50', 'min:2'],
            'gender' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'starts_with:09', 'numeric', 'min:11', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'max:25', 'confirmed'],
            'referrer_id' => ['nullable', 'numeric']
        ],
        [
            'uname.required' => 'Please enter a username.',
            'uname.alpha_num' => 'Your username should only contain letters, numbers and no spaces.',
            'uname.unique' => 'Your chosen username is already in use.',
            'uname.max' => 'Username should not be more than 25 characters.',
            'uname.min' => 'Username should have at least 6 characters.',
            'fname.required' => 'Please enter your first name.',
            'fname.alpha_spaces' => 'Your first name should not have a number or special characters except hypens and spaces.',
            'fname.max' => 'Your first name is too long.',
            'fname.min' => 'Your first name is too short.',
            'lname.required' => 'Please enter your last name.',
            'lname.alpha_spaces' => 'Your last name should not have a number or special characters except hypens and spaces.',
            'lname.max' => 'Your last name is too long.',
            'lname.min' => 'Your last name is too short.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'Your email address is too long.',
            'email.unique' => 'Your email address is already in use.',
            'phone.required' => 'It is very important to provide your working phone number.',
            'phone.starts_with' => 'Please enter a valid phone number.',
            'phone.numeric' => 'Phone numbers should not have any letters or special characters.',
            'phone.min' => 'Your phone number should not be less than 11 numbers',
            'phone.unique' => 'Your phone number is already taken by another user.',
            'password.required' => 'Please enter a password for security.',
            'password.min' => 'Password should not be less than 8 characters long.',
            'password.max' => 'Password should not be more than 25 characters long.',
        ]
    );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        /* Send confirmation TEXT to the user
        $basic  = new \Vonage\Client\Credentials\Basic('4c01d7e7', 'fqxY50yduW8N1P1M');
        $client = new \Vonage\Client($basic);

        $message = 'Congratulations! Welcome to ONEX, we\'re glad to have you. You can now start with your e-loading business, earn rewards by inviting, and more. Happy earnings!';
        $phone = '63'. substr($data['phone'], 1);
        $senderid = 'ONEXPH';

        $response = $client->sms()->send(
            new \Vonage\SMS\Message\SMS($phone, $senderid, $message)
        );

        // Send email confirmation to the user
        /*Mail::send('emails.registered', ['user' => $data], function($message){
            $message->from('support@onex.ph', 'ONEX IT Solutions');
        });*/

        return User::create([
            'uname' => $data['uname'],
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'gender' => $data['gender'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'referrer_id' => $data['referrer_id']
        ]);
    }
}
