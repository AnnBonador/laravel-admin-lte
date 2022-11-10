<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Clinic;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Services;

class AppointmentController extends Controller
{
    public function index()
    {
        return view('admin.appointment.index');
    }
    public function create()
    {
        $starttime = '9:00';  // your start time
        $endtime = '16:00';  // End time
        $duration = '30';  // split by 30 mins

        $array_of_time = array();
        $start_time    = strtotime($starttime); //change to strtotime
        $end_time      = strtotime($endtime); //change to strtotime

        $add_mins  = $duration * 60;

        while ($start_time <= $end_time) // loop between time
        {
            $array_of_time[] = date("h:i A", $start_time);
            $start_time += $add_mins; // to check endtie=me
        }

        $new_array_of_time = array();
        for ($i = 0; $i < count($array_of_time) - 1; $i++) {
            $new_array_of_time[] = '' . $array_of_time[$i] . ' - ' . $array_of_time[$i + 1];
        }

        // dd($new_array_of_time);
        $patients = Patient::get()->pluck('full_name', 'id');
        $clinic = Clinic::pluck('name', 'id');
        return view('admin.appointment.create', compact('clinic', 'new_array_of_time', 'patients'));
    }
}
