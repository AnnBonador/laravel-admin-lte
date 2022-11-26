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
        if (auth()->user()->hasRole('Super-Admin')) {
            $prescriptions = Prescription::all();
        } else if (auth()->user()->hasRole('Clinic Admin')) {
            $prescriptions = Prescription::where('clinic_id', auth()->user()->isClinicAdmin)->get();
        } else if (auth()->user()->hasRole('Doctor')) {
            $prescriptions = Prescription::where('doctor_id', auth()->id())->where('clinic_id', auth()->user()->clinic_id)->get();
        }
        return view('admin.prescription.index', compact('prescriptions'));
    }

    public function create()
    {
        $doctors = User::role('Doctor')->where('clinic_id', auth()->user()->isClinicAdmin)
            ->where('status', '1')
            ->get()
            ->pluck('full_name', 'id');
        $patients = User::where('type', '0')->where('clinic_id', auth()->user()->isClinicAdmin)
            ->where('status', '1')
            ->get()
            ->pluck('full_name', 'id');
        $clinic = Clinic::where('status', '1')->pluck('name', 'id');
        if (auth()->user()->hasRole('Doctor')) {
            $clinic = Clinic::where('status', '1')->where('id', auth()->user()->clinic_id)->pluck('name', 'id');
        }
        return view('admin.prescription.create', compact('clinic', 'doctors', 'patients', 'doctors'));
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
        $doctors = User::role('Doctor')->where('status', '1')->where('clinic_id', $prescription->clinic_id)->get()->pluck('fullname', 'id');
        if (auth()->user()->hasRole('Doctor')) {
            $clinics = Clinic::where('status', '1')->where('id', auth()->user()->clinic_id)->pluck('name', 'id');
            $patients = User::where('type', '0')->where('status', '1')->where('clinic_id', auth()->user()->clinic_id)->get()->pluck('full_name', 'id');
        }
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

    public function print($id)
    {
        $prescription = Prescription::findOrFail($id);
        return view('admin.prescription.pdf', compact('prescription'));
    }
}
