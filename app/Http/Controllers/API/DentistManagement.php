<?php


namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use Validator;
use App\Models\User;
use App\Models\ReviewRating;
use App\Models\Treated;
use Auth;
use DB;
class DentistManagement extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function dentist_information(){
        $query = User::where('type', '=', 1)->get(['fname', 'lname', 'email', 'experience', 'image', 'specialization_id']);

        return response()->json($query);
    }

    public function get_dentist_clinic($id){
        $query = User::where('id', '=', $id)->with('clinic')->first();
        return response()->json($query);
    }

    public function get_treated($id){
        $query = DB::table('treated')
                ->join('appointments', 'treated.app_id', '=', 'appointments.id')
                ->where('appointments.doctor_id', '=', $id)
                ->get();

        return response()->json($query);
    }

    public function create_schedule(Request $request){
        $validator = Validator::make($request->all(), [
            'clinic_id' => 'required',
            'doctor_id' => 'required',
            'day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'duration' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $input = $request->all();
        $schedule = User::create($input);

        return response()->json(['message' => 'Schedule Created Succesfully']);
    }

    public function ratings(){
        $query = ReviewRating::where('status', '=', 'active')->with(['patients', 'doctors', 'appointment'])->get();
        
        return response()->json($query);
    }
}