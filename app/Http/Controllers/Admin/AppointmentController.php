<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Clinic;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Schedule;
use App\Models\Services;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentStoreRequest;
use App\Http\Requests\AppointmentUpdateRequest;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::all();
        return view('admin.appointment.index', compact('appointments'));
    }

    public function create()
    {
        $patients = User::where('type', '0')->where('status', '1')->get()->pluck('full_name', 'id');
        $clinic = Clinic::where('status', '1')->pluck('name', 'id');
        return view('admin.appointment.create', compact('clinic', 'patients'));
    }

    public function store(AppointmentStoreRequest $request)
    {
        $validatedData = $request->validated();
        $appointment = new Appointment();

        $appointment->clinic_id = $validatedData['clinic_id'];
        $appointment->doctor_id = $validatedData['doctor_id'];
        $appointment->patient_id = $validatedData['patient_id'];
        $appointment->schedule_id = $validatedData['schedule_id'];
        $appointment->service = $validatedData['service'];
        $appointment->description = $validatedData['description'];
        $appointment->status = $validatedData['status'];
        $appointment->payment_option = $validatedData['payment_option'];

        $selectedTime = $request->time;
        $preferredTime = explode(" - ", $selectedTime);
        $appointment->start_time = $preferredTime[0];
        $appointment->end_time = $preferredTime[1];

        $appointment->save();

        return redirect()->route('appointments.index')->with('success', 'Appointment added successfully');
    }

    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        $patients = User::where('type', '0')->where('status', '1')->get()->pluck('full_name', 'id');
        $clinic = Clinic::where('status', '1')->pluck('name', 'id');
        $doctor = User::where('type', '2')->where('status', '1')->where('clinic_id', $appointment->clinic_id)->get()->pluck('fullname', 'id');
        $service = Services::where('status', '1')->where('doctor_id', $appointment->doctor_id)->pluck('name');
        $schedule = Schedule::where('doctor_id', $appointment->doctor_id)->pluck('day', 'id');
        return view('admin.appointment.edit', compact('patients', 'clinic', 'appointment', 'doctor', 'service', 'schedule'));
    }

    public function destroy(Request $request)
    {
        $appointment = Appointment::find($request->delete_id);
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully');
    }

    public function update(AppointmentUpdateRequest $request, $id)
    {
        $validatedData = $request->validated();
        $appointment = Appointment::findOrFail($id);

        $appointment->clinic_id = $validatedData['clinic_id'];
        $appointment->doctor_id = $validatedData['doctor_id'];
        $appointment->patient_id = $validatedData['patient_id'];
        $appointment->schedule_id = $validatedData['schedule_id'];
        $appointment->service = $validatedData['service'];
        $appointment->description = $validatedData['description'];
        $appointment->status = $validatedData['status'];
        $appointment->payment_option = $validatedData['payment_option'];

        if (!empty($request->time)) {
            $selectedTime = $request->time;
            $preferredTime = explode(" - ", $selectedTime);
            $appointment->start_time = $preferredTime[0];
            $appointment->end_time = $preferredTime[1];
        }

        $appointment->save();

        return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully');
    }
}
