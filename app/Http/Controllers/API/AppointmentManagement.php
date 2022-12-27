<?php


namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use Validator;
use App\Models\User;
use App\Models\ReviewRating;
use App\Models\Appointment;
use App\Models\Clinic;
use App\Models\Service;
use App\Models\Schedule;
use Auth;
class AppointmentManagement extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_clinic(Request $request){
        $clinic = Clinic::where('status', '1')->pluck('name', 'id')->toArray();
        return response()->json($clinic);
    }

    public function get_doctor($id){
        $doctor = User::where('type', '=', 1)->where('clinic_id', $id)->where('status', '1')->get();
        return response()->json($doctor);
    }

    public function get_service($id){
        $services = Service::where('doctor_id', $id)->where('status', '1')->get();
        $date_id = Schedule::where('day', '>=', date('m/d/Y'))
            ->where('day', '!=', date('m/d/Y'))
            ->where('day', '!=',  date("m/d/Y", strtotime('tomorrow')))
            ->where('doctor_id', $id)
            ->pluck('day', 'id');
        return response()->json(['services' => $services, 'date_id' => $date_id]);
    }
}