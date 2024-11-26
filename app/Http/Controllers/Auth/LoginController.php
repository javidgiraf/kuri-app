<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use App\Helpers\LogActivity;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
    protected $redirectTo = RouteServiceProvider::HOME;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request)
    {
        $sessionData1 = request()->session()->all();
        $sessionData = array_values($sessionData1);


        if (isset($sessionData1['url'])) {

            $user = User::find($sessionData[4]);
        } else {

            $user = User::find($sessionData[3]);
        }

        $this->guard()->logout();
        $request->session()->invalidate();
        LogActivity::addToLog($user->name . " signed out.");
        return $this->loggedOut($request) ?: redirect('/login');
    }
}
