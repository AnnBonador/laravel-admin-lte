<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\RegistrationRequest;
use Symfony\Component\Console\Input\Input;


class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        return view('auth.register1');
    }

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
            } else if (auth()->user()->type == 'doctor') {
                return redirect()->route('doctor.dashboard');
            } else if (auth()->user()->type == 'receptionist') {
                return redirect()->route('receptionist.dashboard');
            } else {
                return redirect()->route('home');
            }
        } else {
            return redirect("login")->withErrors('You have entered invalid credentials');
        }
    }

    // /**
    //  * Write code on Method
    //  *
    //  * @return response()
    //  */


    // /**
    //  * Write code on Method
    //  *
    //  * @return response()
    //  */
}
