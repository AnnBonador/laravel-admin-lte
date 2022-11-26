<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Clinic;
use Illuminate\Http\Request;
use App\Models\Specialization;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminProfileRequest;
use App\Http\Requests\ClinicProfileRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ClinicUpdateRequest;
use App\Http\Requests\DoctorcProfileRequest;
use App\Http\Requests\DoctorUpdateRequest;

class ProfileController extends Controller
{
    public function index()
    {
        $specialize = Specialization::pluck('name', 'id');
        $user = User::where('id', auth()->id())->first();
        if (auth()->user()->hasRole('Super-Admin') || auth()->user()->hasRole('Receptionist')) {
            return view('admin.profile.super-admin', compact('user'));
        } else if (auth()->user()->hasRole('Clinic Admin')) {
            return view('admin.profile.clinic-admin', compact('user', 'specialize'));
        } else if (auth()->user()->hasRole('Doctor')) {
            return view('admin.profile.doctor', compact('user', 'specialize'));
        }
    }

    public function updateClinicAdmin(ClinicProfileRequest $request, $id)
    {
        //uadmin
        $validatedData = $request->validated();
        $clinic_admin = User::findOrFail($id);
        $clinic_admin->fname = $validatedData['fname_admin'];
        $clinic_admin->lname = $validatedData['lname_admin'];
        $clinic_admin->contact = $validatedData['contact_admin'];
        $clinic_admin->dob = $validatedData['dob'];
        $clinic_admin->gender = $validatedData['gender'];

        $old_image = $request->admin_old_image;
        if ($request->hasfile('admin_image')) {

            $image_path = public_path('uploads/admin/');
            if (file_exists($image_path . $old_image)) {
                @unlink($image_path . $old_image);
            }
            $img = $request->file('admin_image');
            $lmg_ext = $img->getClientOriginalExtension();
            $img_name = rand(123456, 999999) . '.' . $lmg_ext;
            $img->move($image_path, $img_name);
            $clinic_admin->image = $img_name;
        } else {
            $clinic_admin->image = $old_image;
        }
        $clinic_admin->save();

        //clinic
        $clinic = Clinic::where('id', auth()->user()->isClinicAdmin)->first();
        $clinic->name = $validatedData['name'];
        $clinic->email = $validatedData['email'];
        $clinic->contact = $validatedData['contact'];
        $clinic->specialization_id = $validatedData['specialization_id'];
        $clinic->address = $validatedData['address'];
        $clinic->country = $validatedData['country'];
        $clinic->city = $validatedData['city'];

        $old_image = $request->clinic_old_image;
        if ($request->hasfile('clinic_image')) {

            $image_path = public_path('uploads/clinic/');
            if (file_exists($image_path . $old_image)) {
                @unlink($image_path . $old_image);
            }
            $img = $request->file('clinic_image');
            $lmg_ext = $img->getClientOriginalExtension();
            $img_name = rand(123456, 999999) . '.' . $lmg_ext;
            $img->move($image_path, $img_name);
            $clinic->image = $img_name;
        } else {
            $clinic->image = $old_image;
        }

        $clinic->save();

        return redirect()->route('change.profile')->with('success', 'Profile updated successfully.');
    }

    public function updateDoctor(DoctorcProfileRequest $request, $id)
    {
        $validatedData = $request->validated();
        $doctor = User::find($id);
        $doctor->fname = $validatedData['fname'];
        $doctor->lname = $validatedData['lname'];
        $doctor->email = $validatedData['email'];
        $doctor->contact = $validatedData['contact'];
        $doctor->dob = $validatedData['dob'];
        $doctor->specialization_id = $validatedData['specialization_id'];
        $doctor->experience = $validatedData['experience'];
        $doctor->gender = $validatedData['gender'];
        $doctor->degree = $validatedData['degree'];
        $doctor->college = $validatedData['college'];
        $doctor->address = $validatedData['address'];
        $doctor->country = $validatedData['country'];
        $doctor->city = $validatedData['city'];

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
        return redirect()->route('change.profile')->with('success', 'Profile updated successfully.');
    }

    public function updateAdmin(AdminProfileRequest $request, $id)
    {
        $validatedData = $request->validated();
        $admin = User::find($id);
        $admin->fname = $validatedData['fname'];
        $admin->lname = $validatedData['lname'];
        $admin->email = $validatedData['email'];
        $admin->contact = $validatedData['contact'];
        $admin->dob = $validatedData['dob'];
        $admin->gender = $validatedData['gender'];
        $admin->address = $validatedData['address'];
        $admin->country = $validatedData['country'];
        $admin->city = $validatedData['city'];

        $old_image = $request->old_image;
        if ($request->hasfile('image')) {

            $image_path = public_path('uploads/admin/');
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

        $admin->image = $final_image;
        $admin->save();
        return redirect()->route('change.profile')->with('success', 'Profile updated successfully.');
    }
}
