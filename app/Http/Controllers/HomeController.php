<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Schedule;
use App\Models\Appointment;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

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

    public function redirectUser()
    {
        if (Auth::user()->type == 'admin') {
            return redirect()->route('admin.dashboard');
        } else if (auth()->user()->type == 'doctor') {
            return redirect()->route('doctor.dashboard');
        } else if (auth()->user()->type == 'receptionist') {
            return redirect()->route('receptionist.dashboard');
        } else {
            return redirect()->route('user.dashboard');
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $events = [];

        $calendar = Appointment::where('patient_id', Auth::user()->id)->get();
        foreach ($calendar as $data) {

            $events[] = [
                'title' => $data->patients->full_name,
                'start' => Carbon::createFromFormat('m/d/Y g:i a', $data->schedule->day . ' ' . $data->start_time)->format('Y-m-d H:i'),
                'end' => Carbon::createFromFormat('m/d/Y g:i a', $data->schedule->day . ' ' . $data->end_time)->format('Y-m-d H:i'),
                'borderColor' => '#00c0ef',
                'url'   => route('user.dashboard.show', $data->id),
            ];
        }
        return view('user.dashboard', compact('events'));
    }

    public function userShow($id)
    {
        $events = Appointment::findOrFail($id);
        return view('user.calendar', compact('events'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        if (auth()->user()->hasRole('Super-Admin')) {
            $total_patients = User::where('type', '0')->count();
            $total_doctors = User::where('type', '2')->count();
            $total_appointments = Appointment::where('status', '!=', 'Completed')->count();
            $appointment = Appointment::orderBy('schedule_id', 'asc')->get();
            $revenue = Transaction::all();
            $total_earnings = $revenue->sum('amount');
        } else if (auth()->user()->hasRole('Clinic Admin')) {
            $total_patients = User::where('type', '0')->where('clinic_id', auth()->user()->isClinicAdmin)->count();
            $total_doctors = User::where('type', '2')->where('clinic_id', auth()->user()->isClinicAdmin)->count();
            $total_appointments = Appointment::where('status', '!=', 'Completed')->where('clinic_id', auth()->user()->isClinicAdmin)->count();
            $appointment = Appointment::orderBy('schedule_id', 'asc')->where('clinic_id', auth()->user()->isClinicAdmin)->get();
            $revenue = Transaction::where('clinic_id', auth()->user()->isClinicAdmin)->get();
            $total_earnings = $revenue->sum('amount');
        }
        return view('admin.dashboard', compact('total_patients', 'total_doctors', 'total_appointments', 'appointment', 'total_earnings'));
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
