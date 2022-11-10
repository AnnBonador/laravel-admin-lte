<?php

namespace App\Http\Controllers\Admin;

use App\Models\Clinic;
use Illuminate\Http\Request;
use App\Models\Specialization;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClinicCreateRequest;
use App\Http\Requests\ClinicUpdateRequest;

class ClinicsController extends Controller
{
    public function index()
    {
        // $data->specialization_id
        // $data = '["2","3"]';
        // $data = json_decode($data);
        // dd($data);
        $clinic = Clinic::all();
        return view('admin.clinics.index', compact('clinic'));
    }

    public function create()
    {
        $specialize = Specialization::pluck('name', 'id');
        return view('admin.clinics.create', compact('specialize'));
    }

    public function store(ClinicCreateRequest $request)
    {
        Clinic::create($request->all());

        return redirect()->route('clinics.index')->with('success', 'Clinic added successfully');
    }

    public function edit($id)
    {
        $clinic = Clinic::findOrFail($id);
        $specialize = Specialization::pluck('name', 'id');
        return view('admin.clinics.edit', compact('clinic', 'specialize'));
    }

    public function update(ClinicUpdateRequest $request, $id)
    {
        $clinic = Clinic::findOrFail($id);
        $clinic->update($request->all());

        return redirect()->route('clinics.index')->with('success', 'Clinic updated successfully');
    }
}
