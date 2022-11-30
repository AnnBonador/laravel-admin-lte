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

        return view('search-doctors', compact('users'));
    }

    public function search(Request $request)
    {
        $results = Search::new()
            ->add(User::where('status', '1')->role('Doctor'), ['fname', 'lname', 'address', 'city', 'country', 'specialization_id'])
            ->add(Service::class, ['name'])
            ->beginWithWildcard()
            ->search(request('search'));

        return view('result', compact('results'));
    }
}
