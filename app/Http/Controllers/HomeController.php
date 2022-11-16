<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Appointment;
use App\Models\Schedule;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
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
    public function index()
    {
        return view('user.dashboard');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        $total_patients = Patient::count();
        $total_doctors = Doctor::count();
        $total_appointments = Appointment::where('status', '!=', 'Completed')->count();
        $appt_today = Appointment::all();
        $revenue = Transaction::all();
        $total_earnings = $revenue->sum('amount');
        return view('admin.dashboard', compact('total_patients', 'total_doctors', 'total_appointments', 'appt_today', 'total_earnings'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function doctorHome()
    {
        return view('doctor.dashboard');
    }

    public function receptionistHome()
    {
        return view('receptionist.dashboard');
    }
}
