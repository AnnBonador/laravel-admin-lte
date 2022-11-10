<?php

namespace App\Http\Controllers\Admin;

use App\Models\Clinic;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\PatientStoreRequest;
use App\Http\Requests\PatientUpdateRequest;

class PatientController extends Controller
{
    public function index()
    {
        $patient = Patient::all();
        return view('admin.patient.index', compact('patient'));
    }

    public function create()
    {
        $clinic = Clinic::where('status', '1')->pluck('name', 'id');
        return view('admin.patient.create', compact('clinic'));
    }

    public function store(PatientStoreRequest $request)
    {
        $validatedData = $request->validated();
        $patient = new Patient();
        $patient->fname = $validatedData['fname'];
        $patient->lname = $validatedData['lname'];
        $patient->email = $validatedData['email'];
        $patient->clinic_id = $validatedData['clinic_id'];
        $patient->contact = $validatedData['contact'];
        $patient->dob = $validatedData['dob'];
        $patient->gender = $validatedData['gender'];
        $patient->address = $validatedData['address'];
        $patient->country = $validatedData['country'];
        $patient->city = $validatedData['city'];
        $patient->status = $validatedData['status'];

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/patient', $filename);
            $patient->image = $filename;
        }
        $patient->save();

        return redirect()->route('patients.index')->with('success', 'Patient added successfully');
    }

    public function edit($id)
    {
        $patient = Patient::findOrFail($id);
        $clinic = Clinic::where('status', '1')->pluck('name', 'id');
        return view('admin.patient.edit', compact('patient', 'clinic'));
    }

    public function update(PatientUpdateRequest $request, $id)
    {
        $validatedData = $request->validated();
        $patient = Patient::find($id);
        $patient->fname = $validatedData['fname'];
        $patient->lname = $validatedData['lname'];
        $patient->email = $validatedData['email'];
        $patient->clinic_id = $validatedData['clinic_id'];
        $patient->contact = $validatedData['contact'];
        $patient->dob = $validatedData['dob'];
        $patient->gender = $validatedData['gender'];
        $patient->address = $validatedData['address'];
        $patient->country = $validatedData['country'];
        $patient->city = $validatedData['city'];
        $patient->status = $validatedData['status'];

        $old_image = $request->old_image;
        if ($request->hasfile('image')) {

            $image_path = public_path('uploads/patient/');
            if (file_exists($image_path . $old_image)) {
                @unlink($image_path . $old_image);
            }
            $img = $request->file('image');
            $lmg_ext = $img->getClientOriginalExtension();
            $img_name = rand(123456, 999999) . '.' . $lmg_ext;
            $img->move($image_path, $img_name);
            $final_image = $img_name;
        } else {
            $final_image = $old_image;
        }

        $patient->image = $final_image;
        $patient->save();
        return redirect()->route('patients.index')->with('success', 'Patient updated successfully.');
    }

    public function destroy(Request $request)
    {
        $patient = patient::find($request->delete_id);
        if ($patient->image) {
            $path = 'uploads/patient/' . $patient->image;
            if (File::exists($path)) {
                File::delete($path);
            }
        }
        $patient->delete();
        return redirect()->route('patients.index')->with('success', 'Patient deleted successfully');
    }
}
