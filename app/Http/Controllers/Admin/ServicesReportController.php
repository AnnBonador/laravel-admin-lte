<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Clinic;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\AppointmentService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class ServicesReportController extends Controller
{
    public function index()
    {
        $from = Carbon::parse(sprintf(
            '%s-%s-01',
            request()->query('y', Carbon::now()->year),
            request()->query('m', Carbon::now()->month)
        ));
        $to      = clone $from;
        $to->day = $to->daysInMonth;

        $service_category = DB::table('appointment_service')
            ->join('appointments', 'appointment_service.appointment_id', '=', 'appointments.id')
            ->join('services', 'appointment_service.service_id', '=', 'services.id')
            ->join('service_category', 'services.service_cid', '=', 'service_category.id')
            ->select('appointment_service.*', 'services.name', 'service_category.name', DB::raw('count(service_cid) AS count'), DB::raw('sum(charges) AS earnings'))
            ->where('appointments.status', 'Completed')
            ->where('appointments.payment_option', 'Paypal')
            ->whereBetween('appointments.updated_at', [$from, $to])
            ->groupBy('service_cid')
            ->orderBy('count', 'desc')
            ->get();

        $procedures = DB::table('appointment_service')
            ->join('appointments', 'appointment_service.appointment_id', '=', 'appointments.id')
            ->join('services', 'appointment_service.service_id', '=', 'services.id')
            ->select('appointment_service.*', 'services.name', 'appointments.created_at', DB::raw('count(service_id) AS count'))
            ->whereBetween('appointments.updated_at', [$from, $to])
            ->where('appointments.status', 'Completed')
            ->groupBy('service_id')
            ->orderBy('count', 'desc')
            ->get();
        // dd($to);

        return view('admin.reports.services-reports.index', compact('service_category', 'procedures'));
    }
}
