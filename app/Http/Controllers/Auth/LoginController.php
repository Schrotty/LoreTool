<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function showLoginForm()
    {
        return \view('auth.login');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }

    /*public function login(Request $request)
    {
        $user = User::all()->where('username', $request->input('username'))->first();
        Debugbar()->info($user);

        //Auth::login($user);

        /*$validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = array();
        $credentials['username'] = $request->input('username');
        $credentials['password'] = $request->input('password');

        Debugbar()->info($credentials);

        $validator->after(function ($validator) use ($credentials) {
            if (!Auth::attempt($credentials, false)) {
                $validator->errors()->add('credentials', 'The entered combination of username/ password is incorrect!');
            }
        });

        if ($validator->fails()) {
            return redirect('/login')
                ->withErrors($validator)
                ->withInput();
        }

        Debugbar()->info(Auth::user());
        return redirect('/');
    }*/
}
