<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Clinic;
use App\Models\Doctor;
use App\Models\Schedule;
use App\Models\Services;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleStoreRequest;
use App\Http\Requests\ScheduleUpdateRequest;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedule = Schedule::all();
        return view('admin.schedule.index', compact('schedule'));
    }

    public function create()
    {
        $clinic = Clinic::where('status', '1')->pluck('name', 'id');
        return view('admin.schedule.create', compact('clinic'));
    }

    public function getDoctor(Request $request)
    {
        $id = $request->clinic_id;
        $doctor = Doctor::where('clinic_id', $id)->where('status', '1')->get()->pluck('full_name', 'id');
        return response()->json($doctor);
    }

    public function getService(Request $request)
    {
        $id = $request->doctor_id;
        $services = Services::where('doctor_id', $id)->where('status', '1')->pluck('name', 'id');
        return response()->json($services);
    }

    public function getSlots(Request $request)
    {
        $id = $request->slots;
        $doctor_id = $request->doctor_id;
        $slot = Schedule::where('day', $id)->where('doctor_id', $doctor_id)->first();

        if (!empty($slot->start_time)) {
            $starttime = $slot->start_time;  // your start time
            $endtime =  $slot->end_time;  // End time
            $duration =  $slot->duration;  // split by 30 mins

            $array_of_time = array();
            $start_time    = strtotime($starttime); //change to strtotime
            $end_time      = strtotime($endtime); //change to strtotime

            $add_mins  = $duration * 60;

            while ($start_time <= $end_time) // loop between time
            {
                $array_of_time[] = date("h:i A", $start_time);
                $start_time += $add_mins; // to check endtie=me
            }

            $new_array_of_time = array();
            for ($i = 0; $i < count($array_of_time) - 1; $i++) {
                $new_array_of_time[] = '' . $array_of_time[$i] . ' - ' . $array_of_time[$i + 1];
            }

        } else {
            return response(['message' => 'not found'], 404);
        }

        return response()->json($new_array_of_time);
    }


    public function store(ScheduleStoreRequest $request)
    {
        $validatedData = $request->validated();
        $schedule = new Schedule();
        $schedule->clinic_id = $validatedData['clinic_id'];
        $schedule->doctor_id = $validatedData['doctor_id'];
        $schedule->day = $validatedData['day'];
        $schedule->start_time = $validatedData['start_time'];
        $schedule->end_time = $validatedData['end_time'];
        $schedule->duration = $validatedData['duration'];

        if (Schedule::where("clinic_id", $validatedData['clinic_id'])->where('day', $validatedData['day'])->exists()) {
            return redirect()->back()->with('error', 'Scheduled date already exists. Select new date');
        }
        $schedule->save();

        return redirect()->route('schedules.index')->with('success', 'Doctor schedule added successfully');
    }

    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id);
        $clinic = Clinic::where('status', '1')->pluck('name', 'id');
        $doctor = Doctor::where('clinic_id', $schedule->clinic_id)->where('status', '1')->get();
        return view("admin.schedule.edit", compact('schedule', 'doctor', 'clinic'));
    }

    public function update(ScheduleStoreRequest $request, $id)
    {
        $validatedData = $request->validated();
        $schedule = Schedule::find($id);
        $schedule->clinic_id = $validatedData['clinic_id'];
        $schedule->doctor_id = $validatedData['doctor_id'];
        $schedule->start_time = $validatedData['start_time'];
        $schedule->end_time = $validatedData['end_time'];
        $schedule->duration = $validatedData['duration'];

        if ($schedule->day === $validatedData['day']) {
            $schedule->day = $validatedData['day'];
        } else {
            if (Schedule::where("clinic_id", $validatedData['clinic_id'])->where('day', $validatedData['day'])->exists()) {
                return redirect()->back()->with('error', 'Scheduled date already exists. Select new date');
            } else {
                $schedule->day = $validatedData['day'];
            }
        }

        $schedule->save();

        return redirect()->route('schedules.index')->with('success', 'Doctor schedule updated successfully');
    }

    public function destroy(Request $request)
    {
        $schedule = Schedule::find($request->delete_id);
        $schedule->delete();
        return redirect()->route('schedules.index')->with('success', 'Doctor schedule deleted successfully');
    }
}
