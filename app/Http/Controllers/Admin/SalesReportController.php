<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Treated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Transaction;

class SalesReportController extends Controller
{
    public function index(Request $request)
    {
        $date = explode(" - ", request()->input('from-to', ""));

        if (count($date) != 2) {
            $date = [now()->subDays(29)->format("Y-m-d H:i:s"), now()->format("Y-m-d H:i:s")];
        }
        $bills = DB::table('appointment_service')
            ->join('appointments', 'appointment_service.appointment_id', '=', 'appointments.id')
            ->join('treated', 'appointments.id', '=', 'treated.app_id')
            ->join('services', 'appointment_service.service_id', '=', 'services.id')
            ->select('appointment_service.*', 'appointments.id', DB::raw('sum(charges) AS earnings'))
            ->where('appointments.status', 'Completed')
            ->where('appointments.payment_option', 'Paypal')
            ->whereBetween('treated.created_at', $date)
            ->get();


        return view('admin.reports.sales-report.index', compact('date','bills'));
    }

    public function printMedical(Request $request)
    {
        $date = explode(" - ", request()->input('from-to', ""));

        if (count($date) != 2) {
            $date_sub = [now()->subDays(29)->format("Y-m-d"), now()->format("Y-m-d")];
            $date = [now()->subDays(29)->format("Y-m-d H:i:s"), now()->format("Y-m-d H:i:s")];
        }

        //patient registered
        $results_patients = User::where('type', '0')->whereBetween('created_at',  $date)->count();

        //treated
        $results_treated = Treated::whereBetween('created_at',  $date)->count();

        return view('admin.reports.medical-report.print', compact('date_sub', 'results_patients', 'results_treated'));
    }
}
