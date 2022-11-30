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
        $doctors = User::with('reviews', 'services')->role('Doctor')->where('clinic_id', $id)->get();

        dd($doctors);
        return view('clinic-profile', compact('clinic', 'services', 'doctors'));
    }

    public function doctorProfile($id)
    {
        $circle_radius = 3959;
        $max_distance = 20;
        $lat = 14.6386436;
        $lng = 121.0538747;

        $distance = DB::select(
            'SELECT * FROM
                    (SELECT id, fname,specialization_id,lname, address, contact, latitude, longitude,
                     (' . $circle_radius . ' * acos(cos(radians(' . $lat . ')) * cos(radians(latitude)) *
                    cos(radians(longitude) - radians(' . $lng . ')) +
                    sin(radians(' . $lat . ')) * sin(radians(latitude))))
                    AS distance
                    FROM users) AS distances
                WHERE distance < ' . $max_distance . ' AND id = ' . $id . '
                ORDER BY distance
                LIMIT 1;'
        );
        $doctor = User::with('reviews')->where('id', $id)->first();
        $services = Service::where('doctor_id', $id)->get();
        $schedule = Schedule::where('doctor_id', $id)->orderBy('id', 'desc')->get();
        $reviews = ReviewRating::where('doctor_id', $id)->get();
        return view('doctor-profile', compact('reviews', 'distance', 'doctor', 'schedule', 'services'));
    }

    public function searchDoctors()
    {
        return view('search-doctors');
    }
}
