<?php

namespace App\Http\Controllers\Admin;

use App\Models\ReviewRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RatingsController extends Controller
{
    public function ratings($id)
    {
        $percentage = ReviewRating::select('star_rating', DB::raw('count(id) as count'))
            ->groupBy('star_rating')
            ->get();

        $total_percentage = $percentage->sum('count');

        $ratings = ReviewRating::where('doctor_id', $id)->get();
        $five_stars = ReviewRating::where('star_rating', '5')->count();
        $four_stars = ReviewRating::where('star_rating', '4')->count();
        $three_stars = ReviewRating::where('star_rating', '3')->count();
        $two_stars = ReviewRating::where('star_rating', '2')->count();
        $one_star = ReviewRating::where('star_rating', '1')->count();
        return view('admin.doctor.ratings.index', compact('ratings', 'five_stars', 'four_stars', 'three_stars', 'two_stars', 'one_star', 'percentage', 'total_percentage'));
    }
}
