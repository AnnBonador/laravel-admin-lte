<?php

namespace App\Http\Controllers\Admin;

use App\Models\Clinic;
use App\Models\Patient;
use App\Models\Schedule;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentStoreRequest;

class AppointmentController extends Controller
{
    public function index()
    {
        //getting dates
        return view('admin.appointment.index');
    }
    public function create()
    {
        $dates = Schedule::where('day', '>=', date('m/d/Y'))
            ->where('day', '!=', date('m/d/Y'))
            ->where('day', '!=',  date("m/d/Y", strtotime('tomorrow')))
            ->where('doctor_id', '10')
            ->pluck('id', 'day')->toArray();


        $schedule = Schedule::where('doctor_id', '10')->pluck('day')->toArray();
        $data2[] = [
            'user_id' => '10',
            'dates' => $schedule
        ];

        $patients = Patient::get()->pluck('full_name', 'id');
        $clinic = Clinic::pluck('name', 'id');
        return view('admin.appointment.create', compact('clinic', 'patients', 'data2'));
    }
    public function store(AppointmentStoreRequest $request)
    {
        $validatedData = $request->validated();
        $appointment = new Appointment();
        $appointment->clinic_id = $validatedData['clinic_id'];
        $appointment->doctor_id = $validatedData['doctor_id'];
        $appointment->patient_id = $validatedData['patient_id'];
        $appointment->booking_id = $validatedData['booking_id'];
        $appointment->schedule_id = $validatedData['schedule_id'];
        $appointment->service = $validatedData['service'];
        $appointment->description = $validatedData['description'];
        $appointment->status = $validatedData['status'];
        $appointment->payment_option = $validatedData['payment_option'];
        $appointment->time = $request->time;
        $appointment->save();
        return redirect()->route('appointments.index')->with('success', 'Appointment added successfully');
    }
}
