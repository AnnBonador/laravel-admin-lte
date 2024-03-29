<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Clinic;
use App\Models\Service;
use App\Models\Schedule;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleStoreRequest;

class ScheduleController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('Super-Admin')) {
            $schedule = Schedule::all();
        } else if (auth()->user()->hasRole('Clinic Admin')) {
            $schedule = Schedule::where('clinic_id', auth()->user()->isClinicAdmin)->get();
        } else if (auth()->user()->hasRole('Doctor')) {
            $schedule = Schedule::where('clinic_id', auth()->user()->clinic_id)->where('doctor_id', auth()->id())->get();
        }
        return view('admin.schedule.index', compact('schedule'));
    }

    public function create()
    {
        if (auth()->user()->hasRole('Super-Admin')) {
            $doctors = User::role('Doctor')->where('status', '1')->get()->pluck('full_name', 'id');
            $clinic = Clinic::where('status', '1')->pluck('name', 'id');
        } else if (auth()->user()->hasRole('Clinic Admin')) {
            $doctors = User::role('Doctor')->where('status', '1')->where('clinic_id', auth()->user()->isClinicAdmin)->get()->pluck('full_name', 'id');
            $clinic = Clinic::where('status', '1')->pluck('name', 'id');
        } else if (auth()->user()->hasRole('Doctor')) {
            $doctors = User::role('Doctor')->where('status', '1')->get()->pluck('full_name', 'id');
            $clinic = Clinic::where('status', '1')->where('id', auth()->user()->clinic_id)->pluck('name', 'id');
        }
        return view('admin.schedule.create', compact('clinic', 'doctors'));
    }

    public function getDoctor(Request $request)
    {
        $id = $request->clinic_id;
        $doctors = User::role('Doctor')->where('clinic_id', $id)->where('status', '1')->get()->pluck('full_name', 'id');
        $patients = User::where('type', '0')->where('clinic_id', $id)->where('status', '1')->get()->pluck('full_name', 'id');
        return response()->json(["doctors" => $doctors, "patients" => $patients]);
    }

    public function getService(Request $request)
    {
        $now = Carbon::now();
        $id = $request->doctor_id;
        $services = Service::where('doctor_id', $id)->where('status', '1')->get();
        $date_id = Schedule::where('day', '>', $now->format('m/d/Y'))
            ->whereRaw(DB::raw("substr(day, -4) = " . $now->format('Y')))
            ->where('doctor_id', $id)
            ->pluck('day', 'id');
        return response()->json(['services' => $services, 'date_id' => $date_id]);
    }

    public function getSlots(Request $request)
    {
        $id = $request->slots;
        $doctor_id = $request->doctor_id;

        $slot = Schedule::where('id', $id)->where('doctor_id', $doctor_id)->first();
        $appointments = Appointment::where('doctor_id', $doctor_id)->get();

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

            // Here I am getting the indexes of the time slot which has appointment
            $indexes_to_be_skipped = array();
            foreach ($appointments as $appointment) {
                for ($i = 0; $i < count($array_of_time); $i++) {
                    if ($array_of_time[$i] == date("h:i A", strtotime($appointment['start_time']))) {
                        $indexes_to_be_skipped[$i] = $i;
                    }
                }
            }

            $new_array_of_time = array();
            for ($i = 0; $i < count($array_of_time) - 1; $i++) {
                $new_array_of_time[] = '' . $array_of_time[$i] . ' - ' . $array_of_time[$i + 1];

                // check if current time slot has already appointment
                if (isset($indexes_to_be_skipped[$i])) {
                    // then remove it
                    unset($new_array_of_time[$i]);
                }
            }

            // resetting index
            $narray_of_time = $new_array_of_time;
            $new_array_of_time = array();
            foreach ($narray_of_time as $item) {
                $new_array_of_time[] = $item;
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
        if (auth()->user()->hasRole('Super-Admin') || auth()->user()->hasRole('Clinic Admin')) {
            $clinic = Clinic::where('status', '1')->pluck('name', 'id');
        } else if (auth()->user()->hasRole('Doctor')) {
            $clinic = Clinic::where('status', '1')->where('id', auth()->user()->clinic_id)->pluck('name', 'id');
        }

        $doctor = User::role('Doctor')->where('status', '1')->where('clinic_id', $schedule->clinic_id)->get()->pluck('full_name', 'id');
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
