<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReviewRating;
use Illuminate\Http\Request;

class RatingsController extends Controller
{
    public function ratings($id)
    {
        $rating = ReviewRating::all();
        return view('admin.doctor.ratings.index', compact('rating'));
    }
}
