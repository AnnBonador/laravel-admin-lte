<?php

namespace App\Http\Controllers\Front;

use App\Models\User;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Stevebauman\Location\Facades\Location;
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
        $doctors = User::with('ratings', 'service')->role('Doctor')->where('status', '1')->get();
        return view('search-doctors', compact('users', 'doctors'));
    }

    public function search(Request $request)
    {
        $results = Search::new()
            ->add(User::where('status', '1')->with('ratings', 'service')->role('Doctor'), ['fname', 'lname', 'address', 'city', 'country', 'specialization_id', 'service.name'])
            ->beginWithWildcard()
            ->search(request('search'));

        return view('result', compact('results'));
    }

    public function sort(Request $request)
    {
        $ip = $request->ip();
        $currentUserInfo = Location::get($ip);
        $doctor = User::with(['ratings', 'service'])
            ->leftJoin('review_ratings', 'review_ratings.doctor_id', '=', 'users.id')
            ->select([
                'users.*',
                DB::raw('AVG(review_ratings.star_rating) as average_rating'),
                DB::raw(" ( 3959 * acos( cos( radians('$currentUserInfo->latitude') ) * cos( radians( users.latitude ) ) * cos( radians( users.longitude ) - radians('$currentUserInfo->longitude') ) + sin( radians('$currentUserInfo->latitude') ) * sin( radians( users.latitude ) ) ) ) AS distance")
            ])
            ->role('Doctor')
            ->groupBy('users.id')
            ->orderByDesc('average_rating')
            ->get();
        // dd($ip);
        if ($request->input('ratings')) {
            $doctors = User::with(['ratings', 'service'])
                ->join('review_ratings', 'review_ratings.doctor_id', '=', 'users.id')
                ->select([
                    'users.*',
                    DB::raw('AVG(review_ratings.star_rating) as average_rating'),
                    DB::raw(" ( 3959 * acos( cos( radians('$request->latitude') ) * cos( radians( users.latitude ) ) * cos( radians( users.longitude ) - radians('$request->longitude') ) + sin( radians('$request->latitude') ) * sin( radians( users.latitude ) ) ) ) AS distance")
                ])
                ->role('Doctor')
                ->groupBy('users.id')
                ->orderByDesc('average_rating')
                ->get();
            return view('filter', compact('doctors'));
        }
        if ($request->input('proximity')) {
            $doctors = User::with(['ratings', 'service'])
                ->leftJoin('review_ratings', 'review_ratings.doctor_id', '=', 'users.id')
                ->select([
                    'users.*',
                    DB::raw('AVG(review_ratings.star_rating) as average_rating'),
                    DB::raw(" ( 3959 * acos( cos( radians('$request->latitude') ) * cos( radians( users.latitude ) ) * cos( radians( users.longitude ) - radians('$request->longitude') ) + sin( radians('$request->latitude') ) * sin( radians( users.latitude ) ) ) ) AS distance")
                ])
                ->havingRaw('distance < 20')->orderBy('distance')
                ->role('Doctor')
                ->groupBy('users.id')
                ->orderByDesc('average_rating')
                ->get();
            return view('filter', compact('doctors'));
        }
        if ($request->input('proximity') && $request->input('ratings')) {
            $doctors = User::with(['ratings', 'service'])
                ->join('review_ratings', 'review_ratings.doctor_id', '=', 'users.id')
                ->select([
                    'users.*',
                    DB::raw('AVG(review_ratings.star_rating) as average_rating'),
                    DB::raw(" ( 3959 * acos( cos( radians('$request->latitude') ) * cos( radians( users.latitude ) ) * cos( radians( users.longitude ) - radians('$request->longitude') ) + sin( radians('$request->latitude') ) * sin( radians( users.latitude ) ) ) ) AS distance")
                ])
                ->havingRaw('distance < 20')->orderBy('distance')
                ->role('Doctor')
                ->groupBy('users.id')
                ->orderByDesc('average_rating')
                ->get();
            return view('filter', compact('doctors'));
        }

        return view('search-doctors', compact('doctors'));
    }
}
