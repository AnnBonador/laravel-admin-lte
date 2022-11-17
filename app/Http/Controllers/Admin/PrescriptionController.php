<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Clinic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PrescriptionStoreRequest;
use App\Models\Prescription;

class PrescriptionController extends Controller
{
    public function index()
    {
        $prescriptions = Prescription::all();
        return view('admin.prescription.index', compact('prescriptions'));
    }

    public function create()
    {
        $clinic = Clinic::where('status', '1')->pluck('name', 'id');
        return view('admin.prescription.create', compact('clinic'));
    }

    public function store(PrescriptionStoreRequest $request)
    {
        Prescription::create($request->all());
        return redirect()->route('prescription.index')->with('success', 'Prescription added successfully');
    }

    public function edit($id)
    {
        $prescription = Prescription::find($id);
        $clinics = Clinic::where('status', '1')->pluck('name', 'id');
        $patients = User::where('type', '0')->where('status', '1')->get()->pluck('full_name', 'id');
        $doctors = User::where('type', '2')->where('status', '1')->where('clinic_id', $prescription->clinic_id)->get()->pluck('fullname', 'id');
        return view("admin.prescription.edit", compact('prescription', 'clinics', 'patients', 'doctors'));
    }

    public function update(PrescriptionStoreRequest $request, $id)
    {
        $prescription = Prescription::findOrFail($id);
        $prescription->update($request->all());

        return redirect()->route('prescription.index')->with('success', 'Prescription updated successfully');
    }

    public function destroy(Request $request)
    {
        $prescription = Prescription::find($request->delete_id);
        $prescription->delete();
        return redirect()->route('prescription.index')->with('success', 'Prescription deleted successfully');
    }
}
