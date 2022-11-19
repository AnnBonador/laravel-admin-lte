<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


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

    protected function authenticated(Request $request, $user)
    {
        if ($user->type == '1') {
            return redirect()->route('admin.dashboard');
        } else if ($user->type == '2') {
            return redirect()->route('doctor.dashboard');
        } else if ($user->type == '3') {
            return redirect()->route('receptionist.dashboard');
        } else {
            return redirect()->route('user.dashboard');
        }
    }

    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {
            if (auth()->user()->type == 'admin') {
                return redirect()->route('admin.dashboard');
            } else if (auth()->user()->type == 'user') {
                return redirect()->route('user.dashboard');
            } else if (auth()->user()->type == 'doctor') {
                return redirect()->route('doctor.dashboard');
            } else if (auth()->user()->type == 'receptionist') {
                return redirect()->route('receptionist.dashboard');
            } else {
                return redirect()->route('login');
            }
        } else {
            return redirect()->route('login')
                ->with('error', 'Email-Address And Password Are Wrong.');
        }
    }
}
