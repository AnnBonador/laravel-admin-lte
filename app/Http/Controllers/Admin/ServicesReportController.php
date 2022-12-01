<?php

namespace App\Http\Controllers\Admin;

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
        $services = Service::whereHas('doctors', function (Builder $query) {
            $query->where('clinic_id', '=', '2');
        })->pluck('name');

        $count = DB::table('appointment_service')
        ->leftjoin('services','services.id','=','appointment_service.service_id')
            ->selectRaw('count(service_id) AS count','appointment_service.*')
            ->groupBy('services.id')
            ->orderBy('count')
            ->get();
        dd($count);
        return view('admin.reports.services-reports.index', compact('services', 'count'));
    }

    public function fetch_data(Request $request)
    {
        if ($request->clinic) {

            $chart_data = Service::whereHas('doctors', function (Builder $query) use ($clinic) {
                $query->where('clinic_id', '=', $clinic);
            })->get();

            // foreach ($chart_data as $row) {
            //     $output[] = array(s
            //         'service' => $row->name,
            //         'total' => $row->count()
            //     );
            // }
            // echo json_encode($output);
            dd($request->clinic);
        }
    }

    //     public function fetch_chart_data($clinic)
    //     {
    //         $data = Service::whereHas('doctors', function (Builder $query) use ($clinic) {
    //             $query->where('clinic_id', '=', $clinic);
    //         })->get();
    //         return $data;
    //     }
}
