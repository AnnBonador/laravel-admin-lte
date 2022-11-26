<?php

namespace App\Http\Controllers\Front;

use App\Models\User;
use App\Models\Clinic;
use App\Models\Services;
use App\Models\ReviewRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Schedule;
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
        $services = Services::whereHas('doctors', function (Builder $query) use ($id) {
            $query->where('clinic_id', $id);
        })->get();
        $doctors = User::role('Doctor')->with('ratings.doctor_id')->where('clinic_id', $id)->get();
        return view('clinic-profile', compact('clinic', 'services', 'doctors'));
    }

    public function doctorProfile($id)
    {
        $doctor = User::find($id);
        $ratings = ReviewRating::where('doctor_id', $id)->get();
        $five_stars = ReviewRating::where('star_rating', '5')->count();
        $four_stars = ReviewRating::where('star_rating', '4')->count();
        $three_stars = ReviewRating::where('star_rating', '3')->count();
        $two_stars = ReviewRating::where('star_rating', '2')->count();
        $one_star = ReviewRating::where('star_rating', '1')->count();
        $services = Services::where('doctor_id', $id)->get();
        $reviews = ReviewRating::where('doctor_id', $id)->get();
        $schedule = Schedule::where('doctor_id', $id)->orderBy('id', 'desc')->get();
        return view('doctor-profile', compact('doctor', 'schedule', 'reviews', 'services', 'five_stars', 'four_stars', 'three_stars', 'two_stars', 'one_star', 'ratings'));
    }
}
