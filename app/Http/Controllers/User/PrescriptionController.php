<?php

namespace App\Http\Controllers\User;

use App\Models\Prescription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PrescriptionController extends Controller
{
    public function index()
    {
        $prescriptions = Prescription::where('patient_id', Auth::id())->get();
        return view('user.prescription.index', compact('prescriptions'));
    }
}
