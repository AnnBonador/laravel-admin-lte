<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminProfileRequest;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::where('id', auth()->id())->first();
        return view('user.profile.index', compact('user'));
    }

    public function update(AdminProfileRequest $request, $id)
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

        $admin->image = $final_image;
        $admin->save();
        return redirect()->route('user.profile')->with('success', 'Profile updated successfully.');
    }
}
