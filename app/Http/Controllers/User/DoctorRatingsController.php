<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ReviewRating;
use Illuminate\Http\Request;

class DoctorRatingsController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'star_rating' => 'required',
            'comments' => 'required|max:255',
        ]);

        $ratings = new ReviewRating;
        $ratings->appointment_id = $request->app_id;
        $ratings->doctor_id = $request->doctor;
        $ratings->patient_id = $request->patient;
        $ratings->star_rating = $request->star_rating;
        $ratings->comments = $request->comments;

        $ratings->save();
        return redirect()->back()->with('success', 'Rating submitted');
    }
}
