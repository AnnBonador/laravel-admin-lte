<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Clinic;
use App\Mail\SendPassword;
use App\Models\Receptionist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ReceptionistStoreRequest;
use App\Http\Requests\ReceptionistUpdateRequest;

class ReceptionistController extends Controller
{
    public function index()
    {
        $receptionists = User::where('type', '3')->get();
        return view('admin.receptionist.index', compact('receptionists'));
    }

    public function create()
    {
        $clinic = Clinic::where('status', '1')->pluck('name', 'id');
        return view('admin.receptionist.create', compact('clinic'));
    }

    public function store(ReceptionistStoreRequest $request)
    {
        $validatedData = $request->validated();
        $receptionist = new User();
        $receptionist->fname = $validatedData['fname'];
        $receptionist->lname = $validatedData['lname'];
        $receptionist->email = $validatedData['email'];
        $receptionist->clinic_id = $validatedData['clinic_id'];
        $receptionist->contact = $validatedData['contact'];
        $receptionist->dob = $validatedData['dob'];
        $receptionist->gender = $validatedData['gender'];
        $receptionist->address = $validatedData['address'];
        $receptionist->country = $validatedData['country'];
        $receptionist->city = $validatedData['city'];
        $receptionist->status = $validatedData['status'];
        $receptionist->type = 3;

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/receptionist', $filename);
            $receptionist->image = $filename;
        }
        $receptionist->save();

        return redirect()->route('receptionist.index')->with('success', 'Receptionist added successfully');
    }

    public function edit($id)
    {
        $receptionist = User::findOrFail($id);
        $clinic = Clinic::where('status', '1')->pluck('name', 'id');
        return view('admin.receptionist.edit', compact('receptionist', 'clinic'));
    }

    public function update(ReceptionistUpdateRequest $request, $id)
    {
        $validatedData = $request->validated();
        $receptionist = User::find($id);
        $receptionist->fname = $validatedData['fname'];
        $receptionist->lname = $validatedData['lname'];
        $receptionist->email = $validatedData['email'];
        $receptionist->clinic_id = $validatedData['clinic_id'];
        $receptionist->contact = $validatedData['contact'];
        $receptionist->dob = $validatedData['dob'];
        $receptionist->gender = $validatedData['gender'];
        $receptionist->address = $validatedData['address'];
        $receptionist->country = $validatedData['country'];
        $receptionist->city = $validatedData['city'];
        $receptionist->status = $validatedData['status'];

        $old_image = $request->old_image;
        if ($request->hasfile('image')) {

            $image_path = public_path('uploads/receptionist/');
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

        $receptionist->image = $final_image;
        $receptionist->save();
        return redirect()->route('receptionist.index')->with('success', 'Receptionist updated successfully.');
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
        return redirect()->back()->with('success', 'Receptionist credential send successfully');
    }

    public function updateStatus(Request $request)
    {
        $user = User::findOrFail($request->receptionist_id);
        $user->status = $request->status;
        $user->save();

        return response()->json(['success' => 'Receptionist status updated successfully.']);
    }
}
