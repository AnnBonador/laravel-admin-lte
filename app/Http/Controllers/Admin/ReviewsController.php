<?php

namespace App\Http\Controllers\Admin;

use App\Models\ReviewRating;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class ReviewsController extends Controller
{
    public function index()
    {
        $reviews = ReviewRating::all();
        if (auth()->user()->hasRole('Clinic Admin')) {
            $reviews = ReviewRating::whereHas('appointment', function (Builder $query) {
                $query->where('clinic_id', '=', auth()->user()->isClinicAdmin);
            })->get();
        } else if (auth()->user()->hasRole('Doctor')) {
            $reviews = ReviewRating::where('doctor_id', auth()->id())->get();
        } else if (auth()->user()->hasRole('Receptionist')) {
            $reviews = ReviewRating::whereHas('appointment', function (Builder $query) {
                $query->where('clinic_id', '=', auth()->user()->cinic_id);
            })->get();
        }
        return view('admin.reviews.index', compact('reviews'));
    }
}
