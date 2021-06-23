<?php

namespace Illuminate\Foundation\Auth;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm($uname = null)
    {
        // IF NO USERNAME, REDIRECT TO REG FORM WITHOUT REFERRER
        if ($uname == null)
        {
            return view('auth.register');
        }
        
        // RETRIEVE THE ID FROM THE GIVEN USERNAME
        // ALSO CHECK IF THE USER EXIST WITH THE USERNAME
        if (User::where('uname', $uname)->exists())
        {
            // RETURN VIEW WITH USER INFO
            $user = User::where('uname', $uname)->first();
            return view('auth.register')->with('referrer', $user);
        }
        else
        {
            // RETURN VIEW SHOW ERROR INVALID LINK
            return view('auth.register')->with('invalid_link', true);
        }
        
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
                    ? new JsonResponse([], 201)
                    : redirect($this->redirectPath());
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        //
    }
}
