<?php


namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use Validator;
use App\Models\User;
use App\Models\Prescription;
use Auth;
class PatientManagement extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function prescription_list($id){
        //doctor $id
        $patient = Prescription::where('doctor_id', $id)->get();
        return response()->json($patient);
    }

    public function view_prescription($id){
        $prescription = Prescription::where('id', '=', $id)->first();
        return response()->json($prescription);
    }
}