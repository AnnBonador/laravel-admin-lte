<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClinicCreateRequest;
use App\Models\Clinic;
use Illuminate\Http\Request;

class ClinicsController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Clinics'
        ];
        $clinic = Clinic::all();
        return view('admin.clinics.index', $data, compact('clinic'));
    }

    public function create()
    {
        return view('admin.clinics.create');
    }

    public function store(ClinicCreateRequest $request)
    {
        $validatedData = $request->validated();
        $clinic = new Clinic();
        $clinic->name = $validatedData['name'];
        $clinic->email = $validatedData['email'];
        $clinic->contact = $validatedData['contact'];
        $clinic->specialization = $validatedData['specialization'];
        $clinic->status = $validatedData['status'];
        $clinic->address = $validatedData['address'];
        $clinic->country = $validatedData['country'];
        $clinic->city = $validatedData['city'];
        $clinic->doctor_id = 2;
        $clinic->save();

        return redirect()->route('clinics.index')->with('success', 'Clinic added successfully');
    }
}
