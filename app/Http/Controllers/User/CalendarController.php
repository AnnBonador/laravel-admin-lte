<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    public function index()
    {
        $events = [];

        $calendar = Appointment::where('patient_id', Auth::user()->id)->get();
        foreach ($calendar as $data) {

            $events[] = [
                'title' => $data->patients->full_name,
                'start' => Carbon::createFromFormat('m/d/Y g:i a', $data->schedule->day . ' ' . $data->start_time)->format('Y-m-d H:i'),
                'end' => Carbon::createFromFormat('m/d/Y g:i a', $data->schedule->day . ' ' . $data->end_time)->format('Y-m-d H:i'),
                'borderColor' => '#00c0ef',
                'url'   => route('user.calendar.show', $data->id),
            ];
        }
        return view('user.calendar.index', compact('events'));
    }

    public function show($id)
    {
        $events = Appointment::findOrFail($id);
        return view('user.calendar.show', compact('events'));
    }
}
