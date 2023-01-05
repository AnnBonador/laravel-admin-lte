<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Service;
use App\Mail\Appointment;
use Illuminate\Http\Request;
use App\Models\AppointmentService;
use App\Http\Controllers\Controller;
use App\Models\Appointment as ModelsAppointment;
use App\Models\Treated;

class MedicalController extends Controller
{

    public function filter(Request $request)
    {
        $date = explode(" - ", request()->input('from-to', ""));

        if (count($date) != 2) {
            $date = [now()->subDays(29)->format("Y-m-d H:i:s"), now()->format("Y-m-d H:i:s")];
        }

        //patient registered
        if (auth()->user()->hasRole('Super-Admin')) {
            $results_patients = User::where('type', '0')->whereBetween('created_at', $date)->count();
        } else if (auth()->user()->hasRole('Clinic Admin')) {
            $results_patients = User::where('clinic_id', auth()->user()->isClinicAdmin)->whereBetween('updated_at', $date)->count();
        }

        //treated
        if (auth()->user()->hasRole('Clinic Admin')) {
            $results_treated = Treated::whereHas('appointment', function ($query) use ($date) {
                $query->where('clinic_id', auth()->user()->isClinicAdmin)->whereBetween('created_at',  $date);
            })->count();
        } else if (auth()->user()->hasRole('Super-Admin')) {
            $results_treated = Treated::whereBetween('created_at',  $date)->count();
        }

        return view('admin.reports.medical-report.view', compact('results_patients', 'results_treated'));
    }

    public function printMedical(Request $request)
    {
        $date = explode(" - ", request()->input('from-to', ""));

        if (count($date) != 2) {
            $date_sub = [now()->subDays(29)->format("Y-m-d"), now()->format("Y-m-d")];
            $date = [now()->subDays(29)->format("Y-m-d H:i:s"), now()->format("Y-m-d H:i:s")];
        }

        //patient registered
        if (auth()->user()->hasRole('Super-Admin')) {
            $results_patients = User::where('type', '0')->whereBetween('created_at', $date)->count();
        } else if (auth()->user()->hasRole('Clinic Admin')) {
            $results_patients = User::where('clinic_id', auth()->user()->isClinicAdmin)->whereBetween('created_at', $date)->count();
        }

        //treated
        if (auth()->user()->hasRole('Super-Admin')) {
            $results_treated = Treated::whereBetween('created_at',  $date)->count();
        } else if (auth()->user()->hasRole('Clinic Admin')) {
            $results_treated = Treated::whereHas('appointment', function ($query) use ($date) {
                $query->where('clinic_id', auth()->user()->isClinicAdmin)->whereBetween('created_at',  $date);
            })->count();
        }

        return view('admin.reports.medical-report.print', compact('date_sub', 'results_patients', 'results_treated'));
    }
}
