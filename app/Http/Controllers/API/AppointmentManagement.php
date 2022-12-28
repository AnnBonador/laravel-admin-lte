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
        $clinic = Clinic::where('status', '1')->get(['name', 'id']);
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

    public function get_doctor_slots(Request $request){
        $id = $request->slots;
        $doctor_id = $request->doctor_id;

        $slot = Schedule::where('id', $id)->where('doctor_id', $doctor_id)->first();
        $appointments = Appointment::where('doctor_id', $doctor_id)->get();

        if (!empty($slot->start_time)) {
            $starttime = $slot->start_time;  // your start time
            $endtime =  $slot->end_time;  // End time
            $duration =  $slot->duration;  // split by 30 mins

            $array_of_time = array();
            $start_time    = strtotime($starttime); //change to strtotime
            $end_time      = strtotime($endtime); //change to strtotime

            $add_mins  = $duration * 60;

            while ($start_time <= $end_time) // loop between time
            {
                $array_of_time[] = date("h:i A", $start_time);
                $start_time += $add_mins; // to check endtie=me
            }

            // Here I am getting the indexes of the time slot which has appointment
            $indexes_to_be_skipped = array();
            foreach ($appointments as $appointment) {
                for ($i = 0; $i < count($array_of_time); $i++) {
                    if ($array_of_time[$i] == date("h:i A", strtotime($appointment['start_time']))) {
                        $indexes_to_be_skipped[$i] = $i;
                    }
                }
            }

            $new_array_of_time = array();
            for ($i = 0; $i < count($array_of_time) - 1; $i++) {
                $new_array_of_time[] = '' . $array_of_time[$i] . ' - ' . $array_of_time[$i + 1];

                // check if current time slot has already appointment
                if (isset($indexes_to_be_skipped[$i])) {
                    // then remove it
                    unset($new_array_of_time[$i]);
                }
            }

            // resetting index
            $narray_of_time = $new_array_of_time;
            $new_array_of_time = array();
            foreach ($narray_of_time as $item) {
                $new_array_of_time[] = $item;
            }
        } else {
            return response(['message' => 'not found'], 404);
        }

        return response()->json($new_array_of_time);
    }

    public function appointmentTrigger(Request $request){
        $validator = Validator::make($request->all(), [
            'clinic_id' => 'required',
            'doctor_id' => 'required',
            'patient_id' => 'required',
            'schedule_id' => 'required',
            'start_time' => 'required',
            
            'payment_option' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }
        $user = Appointment::create($request->all());
        return response()->json(['success'=> 'Appointment Succesfully Set']);
    }

    //for patient
    public function get_patient_appointment($id){
        $get_appointment_by_id = Appointment::where('patient_id', '=', $id)->get();
        return response()->json($get_appointment_by_id);
    }

    public function get_appointment(){
        $get_appointment_by_id = Appointment::where('doctor_id', '=', $id)->get();
        return response()->json($get_appointment_by_id);
    }
}