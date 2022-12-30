<?php


namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use Validator;
use App\Models\User;
use App\Models\ReviewRating;
use App\Models\Treated;
use Auth;
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

    public function get_treated(){
        $query = DB::table('treated')
                ->join('appointment', 'treated.app_id', '=', 'appointment.id')
                ->get();

        return response()->json($query);
    }

    public function ratings(){
        $query = ReviewRating::where('status', '=', 'active')->with(['patients', 'doctors', 'appointment'])->get();
        
        return response()->json($query);
    }
}