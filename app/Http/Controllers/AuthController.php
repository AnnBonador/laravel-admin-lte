<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\RegistrationRequest;
use Symfony\Component\Console\Input\Input;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class AuthController extends Controller
{
    use AuthenticatesUsers;


    public function RedirectsUsers()
    {
        if (Auth::user()->type == 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('user.dashboard');
        }
    }

    public function index()
    {
        return view('auth.login');
    }


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;


    /**
     * Write code on Method
     *
     * @return response()
     */

    // /**
    //  * Write code on Method
    //  *
    //  * @return response()
    //  */
    public function postLogin(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $remember_me = $request->has('remember') ? true : false;

        if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']), $remember_me)) {
            if (auth()->user()->type == 'admin') {
                return redirect()->route('admin.dashboard');
            } else if (auth()->user()->type == 'user') {
                return redirect()->route('user.dashboard');
            } else {
                return redirect()->route('home');
            }
        } else {
            return redirect("login")->withErrors('You have entered invalid credentials');
        }
    }

    public function logout(Request $request)
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
