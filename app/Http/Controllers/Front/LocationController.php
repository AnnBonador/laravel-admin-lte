<?php

namespace App\Http\Controllers\Front;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Service;
use ProtoneMedia\LaravelCrossEloquentSearch\Search;

class LocationController extends Controller
{
    public function index(Request $request)
    {
        $circle_radius = 3959;
        $max_distance = 20;
        $lat = 14.6386436;
        $lng = 121.0538747;

        $users = DB::select(
            'SELECT * FROM
                    (SELECT id, fname,specialization_id,lname, address, contact, latitude, longitude,
                     (' . $circle_radius . ' * acos(cos(radians(' . $lat . ')) * cos(radians(latitude)) *
                    cos(radians(longitude) - radians(' . $lng . ')) +
                    sin(radians(' . $lat . ')) * sin(radians(latitude))))
                    AS distance
                    FROM users) AS distances
                WHERE distance < ' . $max_distance . '
                ORDER BY distance;'
        );
        $doctors = User::with('service')->role('Doctor')->where('status', '1')->get();
        return view('search-doctors', compact('users', 'doctors'));
    }

    public function search(Request $request)
    {
        $results = Search::new()
            ->add(User::where('status', '1')->with('service')->role('Doctor'), ['fname', 'lname', 'address', 'city', 'country', 'specialization_id', 'service.name'])
            ->beginWithWildcard()
            ->search(request('search'));

        return view('result', compact('results'));
    }

    public function sort(Request $request)
    {
        $doctors = User::with('reviews', 'service')->role('Doctor')->where('status', '1')->get();
        if ($request->input('ratings')) {
            $doctors = User::query()
                ->selectRaw('*, avg(review_ratings.star_rating) as average_rating')
                ->join('review_ratings', 'review_ratings.doctor_id', 'users.id')
                ->join('services', 'services.doctor_id', 'users.id')
                ->orderBy('review_ratings.star_rating')
                ->orderByDesc('average_rating')
                ->get();
            return view('filter', compact('doctors'));
        }
        return view('search-doctors', compact('doctors'));
    }
}
