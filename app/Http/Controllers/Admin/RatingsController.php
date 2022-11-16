<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReviewRating;
use Illuminate\Http\Request;

class RatingsController extends Controller
{
    public function ratings($id)
    {

        $ratings = ReviewRating::where('doctor_id', $id)->get();
        $five_stars = ReviewRating::where('star_rating', '5')->count();
        $four_stars = ReviewRating::where('star_rating', '4')->count();
        $three_stars = ReviewRating::where('star_rating', '3')->count();
        $two_stars = ReviewRating::where('star_rating', '2')->count();
        $one_star = ReviewRating::where('star_rating', '1')->count();
        return view('admin.doctor.ratings.index', compact('ratings', 'five_stars', 'four_stars', 'three_stars', 'two_stars', 'one_star'));
    }
}
