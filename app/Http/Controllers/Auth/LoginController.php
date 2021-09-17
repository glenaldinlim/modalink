<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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
    protected function redirectTo() {
        if (Auth::user()->role_name == 'Investor') {
            return redirect(RouteServiceProvider::INVESTOR_HOME);
        } else if (Auth::user()->role_name == 'Merchant') {
            return redirect(RouteServiceProvider::MERCHANT_HOME);
        } else if (Auth::user()->role_name == 'Bod' || Auth::user()->role_name == 'Webmaster' || Auth::user()->role_name == 'Admin') {
            return redirect(RouteServiceProvider::ADMIN_HOME);
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        if (Auth::user()->role_name == 'Investor') {
            return redirect()->intended(RouteServiceProvider::INVESTOR_HOME);
        } else if (Auth::user()->role_name == 'Merchant') {
            return redirect()->intended(RouteServiceProvider::MERCHANT_HOME);
        } else if (Auth::user()->role_name == 'Bod' || Auth::user()->role_name == 'Webmaster' || Auth::user()->role_name == 'Admin') {
            return redirect()->intended(RouteServiceProvider::ADMIN_HOME);
        }
    }
}
