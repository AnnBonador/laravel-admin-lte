<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleStoreRequest;
use App\Http\Requests\ScheduleUpdateRequest;
use App\Models\Clinic;
use App\Models\Doctor;
use App\Models\Schedule;
use App\Models\Services;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedule = Schedule::all();
        return view('admin.schedule.index', compact('schedule'));
    }

    public function create()
    {
        $doctor = Doctor::get()->pluck('full_name', 'id');
        $clinic = Clinic::pluck('name', 'id');
        return view('admin.schedule.create', compact('doctor', 'clinic'));
    }

    public function getDoctor(Request $request)
    {
        $id = $request->clinic_id;
        $doctor = Doctor::where('clinic_id', $id)->get()->pluck('full_name', 'id');
        return response()->json($doctor);
    }

    public function getService(Request $request)
    {
        $id = $request->doctor_id;
        $services = Services::where('doctor_id', $id)->pluck('name', 'id');
        return response()->json($services);
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
        $clinic = Clinic::pluck('name', 'id');
        $doctor = Doctor::where('clinic_id', $schedule->clinic_id)->get();
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
