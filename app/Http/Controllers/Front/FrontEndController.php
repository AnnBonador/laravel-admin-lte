<?php

namespace App\Http\Controllers\Front;

use App\Models\User;
use App\Models\Clinic;
use App\Models\Service;
use App\Models\Schedule;
use App\Models\ReviewRating;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Stevebauman\Location\Facades\Location;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function homepage()
    {
        return view('welcome');
    }
    public function dentist()
    {
        return view('dentist');
    }
    public function clinics()
    {
        return view('clinics');
    }

    public function clinicProfile($id)
    {
        $clinic = Clinic::findOrFail($id);
        $services = Service::whereHas('doctors', function (Builder $query) use ($id) {
            $query->where('clinic_id', $id);
        })->get();
        $doctors = User::with('ratings', 'service')->role('Doctor')->where('clinic_id', $id)->get();
        return view('clinic-profile', compact('clinic', 'services', 'doctors'));
    }

    public function doctorProfile(Request $request, $id)
    {
        $doctor = User::with('ratings')->where('id', $id)->first();
        $services = Service::where('doctor_id', $id)->get();
        $schedule = Schedule::where('doctor_id', $id)->orderBy('id', 'desc')->get();
        $reviews = ReviewRating::where('doctor_id', $id)->get();
        return view('doctor-profile', compact('reviews', 'doctor', 'schedule', 'services'));
    }

    public function searchDoctors()
    {
        return view('search-doctors');
    }
}
