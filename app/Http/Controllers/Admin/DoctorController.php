<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Clinic;
use App\Models\Doctor;
use App\Mail\SendPassword;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Specialization;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\DoctorStoreRequest;
use App\Http\Requests\DoctorUpdateRequest;

class DoctorController extends Controller
{
    public function index()
    {
        $doctor = User::where('type', '2')->get();
        return view('admin.doctor.index', compact('doctor'));
    }

    public function create()
    {
        $clinic = Clinic::where('status', '1')->pluck('name', 'id');
        $specialize = Specialization::pluck('name', 'id');
        return view('admin.doctor.create', compact('clinic', 'specialize'));
    }

    public function store(DoctorStoreRequest $request)
    {
        $validatedData = $request->validated();
        $doctor = new User;
        $doctor->fname = $validatedData['fname'];
        $doctor->lname = $validatedData['lname'];
        $doctor->email = $validatedData['email'];
        $doctor->clinic_id = $validatedData['clinic_id'];
        $doctor->contact = $validatedData['contact'];
        $doctor->dob = $validatedData['dob'];
        $doctor->specialization_id = $validatedData['specialization_id'];
        $doctor->experience = $validatedData['experience'];
        $doctor->gender = $validatedData['gender'];
        $doctor->address = $validatedData['address'];
        $doctor->country = $validatedData['country'];
        $doctor->city = $validatedData['city'];
        $doctor->status = $validatedData['status'];
        $doctor->type = 2;

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/doctor', $filename);
            $doctor->image = $filename;
        }

        $pw = generatePass();
        $doctor->password = Hash::make($pw);

        $doctor->save();

        $mailData = [
            'email' => $doctor->email,
            'password' => $pw
        ];

        Mail::to($doctor->email)->send(new SendPassword($mailData));

        return redirect()->route('doctors.index')->with('success', 'Doctor added successfully');
    }

    public function resendCredentials($id)
    {
        $resend = User::find($id);
        $pw = generatePass();
        $resend->password = Hash::make($pw);
        $resend->save();

        $mailData = [
            'email' => $resend->email,
            'password' => $pw
        ];

        Mail::to($resend->email)->send(new SendPassword($mailData));
        return redirect()->back()->with('success', 'Doctor credential send successfully');
    }

    public function edit($id)
    {
        $doctor = User::findOrFail($id);
        $specialize = Specialization::pluck('name', 'id');
        $clinic = Clinic::where('status', '1')->pluck('name', 'id');
        return view('admin.doctor.edit', compact('doctor', 'clinic', 'specialize'));
    }

    public function update(DoctorUpdateRequest $request, $id)
    {
        $validatedData = $request->validated();
        $doctor = User::find($id);
        $doctor->fname = $validatedData['fname'];
        $doctor->lname = $validatedData['lname'];
        $doctor->email = $validatedData['email'];
        $doctor->clinic_id = $validatedData['clinic_id'];
        $doctor->contact = $validatedData['contact'];
        $doctor->dob = $validatedData['dob'];
        $doctor->specialization_id = $validatedData['specialization_id'];
        $doctor->experience = $validatedData['experience'];
        $doctor->gender = $validatedData['gender'];
        $doctor->address = $validatedData['address'];
        $doctor->country = $validatedData['country'];
        $doctor->city = $validatedData['city'];
        $doctor->status = $validatedData['status'];

        $old_image = $request->old_image;
        if ($request->hasfile('image')) {

            $image_path = public_path('uploads/doctor/');
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

        $doctor->image = $final_image;
        $doctor->save();
        return redirect()->route('doctors.index')->with('success', 'Doctor updated successfully.');
    }

    public function destroy(Request $request)
    {
        $doctor = User::find($request->delete_id);
        if ($doctor->image) {
            $path = 'uploads/doctor/' . $doctor->image;
            if (File::exists($path)) {
                File::delete($path);
            }
        }
        $doctor->delete();
        return redirect()->route('doctors.index')->with('success', 'Doctor deleted successfully');
    }

    public function updateStatus(Request $request)
    {
        $user = User::findOrFail($request->doctor_id);
        $user->status = $request->status;
        $user->save();

        return response()->json(['success' => 'Doctor status updated successfully.']);
    }
}
