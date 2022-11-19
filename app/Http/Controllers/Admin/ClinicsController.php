<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Clinic;
use App\Mail\SendPassword;
use Illuminate\Http\Request;
use App\Models\Specialization;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ClinicCreateRequest;
use App\Http\Requests\ClinicUpdateRequest;
use App\Mail\SendPasswordAdmin;

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
        $clinic = Clinic::create($request->all());
        $lastid = $clinic->id;

        $validatedData = $request->validated();
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
        $clinic = Clinic::findOrFail($id);
        $clinic->update($request->all());

        $validatedData = $request->validated();
        $clinic_admin = User::where('clinic_id', $id)->first();
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
        $clinic_admin->save();

        return redirect()->route('clinics.index')->with('success', 'Clinic updated successfully');
    }

    public function destroy(Request $request)
    {
        $clinic = Clinic::find($request->delete_id);
        $clinic->delete();
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
