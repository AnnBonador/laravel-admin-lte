<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Clinic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ClinicController extends Controller
{
    public function index()
    {
        $clinics = Clinic::where('status', '1')->pluck('name', 'id');
        return view('user.clinic.edit', compact('clinics'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'clinic' => 'required'
        ]);

        $clinic_id = User::where('id', Auth::id())->firstOrFail();
        $clinic_id->clinic_id = $request->clinic;
        $clinic_id->save();
        return redirect()->back()->with('success', 'Your clinic updated successfully');
    }
}
