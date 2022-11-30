<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Clinic;
use App\Mail\SendPassword;
use Illuminate\Http\Request;
use App\Models\Specialization;
use App\Mail\SendPasswordAdmin;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ClinicCreateRequest;
use App\Http\Requests\ClinicUpdateRequest;

class ClinicsController extends Controller
{
    public function index()
    {
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
        $validatedData = $request->validated();
        $clinic = new Clinic();
        $clinic->name = $validatedData['name'];
        $clinic->email = $validatedData['email'];
        $clinic->contact = $validatedData['contact'];
        $clinic->specialization_id = $validatedData['specialization_id'];
        $clinic->status = $validatedData['status'];
        $clinic->address = $validatedData['address'];
        $clinic->country = $validatedData['country'];
        $clinic->city = $validatedData['city'];
        $clinic->latitude = $validatedData['latitude'];
        $clinic->longitude = $validatedData['longitude'];

        if ($request->hasfile('clinic_image')) {
            $file = $request->file('clinic_image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/clinic', $filename);
            $clinic->image = $filename;
        }
        $clinic->save();
        $lastid = $clinic->id;

        $clinic_admin = new User();
        $clinic_admin->clinic_id = $lastid;
        $clinic_admin->fname = $validatedData['fname_admin'];
        $clinic_admin->lname = $validatedData['lname_admin'];
        $clinic_admin->email = $validatedData['email_admin'];
        $clinic_admin->contact = $validatedData['contact_admin'];
        $clinic_admin->dob = $validatedData['dob'];
        $clinic_admin->gender = $validatedData['gender'];
        $clinic_admin->type = 1;
        $clinic_admin->status = 1;
        $clinic_admin->isClinicAdmin = $lastid;
        $pw = generatePass();
        $clinic_admin->password = Hash::make($pw);

        if ($request->hasfile('admin_image')) {
            $file = $request->file('admin_image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/admin', $filename);
            $clinic_admin->image = $filename;
        }
        $clinic_admin->assignRole('Clinic Admin');
        $clinic_admin->save();

        $mailData = [
            'email' => $clinic_admin->email,
            'password' => $pw
        ];

        Mail::to($clinic_admin->email)->send(new SendPasswordAdmin($mailData));

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
        //clinic
        $validatedData = $request->validated();
        $clinic = Clinic::findOrFail($id);
        $clinic->name = $validatedData['name'];
        $clinic->email = $validatedData['email'];
        $clinic->contact = $validatedData['contact'];
        $clinic->specialization_id = $validatedData['specialization_id'];
        $clinic->status = $validatedData['status'];
        $clinic->address = $validatedData['address'];
        $clinic->country = $validatedData['country'];
        $clinic->city = $validatedData['city'];
        $clinic->latitude = $validatedData['latitude'];
        $clinic->longitude = $validatedData['longitude'];

        $old_image_clinic = $request->clinic_old_image;

        if ($request->hasfile('clinic_image')) {
            $image_path_clinic = public_path('uploads/clinic/');
            if (file_exists($image_path_clinic . $old_image_clinic)) {
                @unlink($image_path_clinic . $old_image_clinic);
            }
            $img_clinic = $request->file('clinic_image');
            $lmg_ext_clinic = $img_clinic->getClientOriginalExtension();
            $img_name_clinic = rand(123456, 999999) . '.' . $lmg_ext_clinic;
            $img_clinic->move($image_path_clinic, $img_name_clinic);
            $clinic->image = $img_name_clinic;
        } else {
            $clinic->image = $old_image_clinic;
        }
        $clinic->save();

        //uadmin
        $clinic_admin = User::where('isClinicAdmin', $id)->first();
        $clinic_admin->fname = $validatedData['fname_admin'];
        $clinic_admin->lname = $validatedData['lname_admin'];

        if ($clinic_admin->email != $request->email_admin) {
            if (User::where('email', $request->email_admin)->exists()) {
                return redirect()->back()->with('error', 'Email already exists successfully');
            } else {
                $clinic_admin->email = $validatedData['email_admin'];
            }
        }
        $clinic_admin->contact = $validatedData['contact_admin'];
        $clinic_admin->dob = $validatedData['dob'];
        $clinic_admin->gender = $validatedData['gender'];

        $old_image_admin = $request->admin_old_image;
        if ($request->hasfile('admin_image')) {

            $image_path_admin = public_path('uploads/admin/');
            if (file_exists($image_path_admin . $old_image_admin)) {
                @unlink($image_path_admin . $old_image_admin);
            }
            $img_admin = $request->file('admin_image');
            $lmg_ext_admin = $img_admin->getClientOriginalExtension();
            $img_name_admin = rand(123456, 999999) . '.' . $lmg_ext_admin;
            $img_admin->move($image_path_admin, $img_name_admin);
            $clinic_admin->image = $img_name_admin;
        } else {
            $clinic_admin->image = $old_image_admin;
        }
        $clinic_admin->save();

        return redirect()->route('clinics.index')->with('success', 'Clinic updated successfully');
    }

    public function destroy(Request $request)
    {
        $clinic = Clinic::find($request->delete_id);
        if ($clinic->image) {
            $image_path = public_path('uploads/clinic/');
            if (file_exists($image_path . $clinic->image)) {
                @unlink($image_path . $clinic->image);
            }
        }
        $clinic->delete();

        $user = User::where('isClinicAdmin', $request->delete_id)->first();
        if ($user->image) {
            $image_path = public_path('uploads/admin/');
            if (file_exists($image_path . $user->image)) {
                @unlink($image_path . $user->image);
            }
        }
        $user->delete();

        return redirect()->route('clinics.index')->with('success', 'Clinic and clinic admin panel deleted successfully');
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
        return redirect()->back()->with('success', 'Clinic admin credential send successfully');
    }

    public function updateStatus(Request $request)
    {
        $user = Clinic::findOrFail($request->clinic_id);
        $user->status = $request->status;
        $user->save();

        return response()->json(['success' => 'Clinic status updated successfully.']);
    }
}
