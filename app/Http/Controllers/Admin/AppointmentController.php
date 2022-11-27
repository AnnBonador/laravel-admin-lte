<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Clinic;
use App\Models\Treated;
use App\Models\Schedule;
use App\Models\Services;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\Appointment as MailAppointment;
use App\Http\Requests\AppointmentStoreRequest;
use App\Http\Requests\AppointmentUpdateRequest;

class AppointmentController extends Controller
{
    public function all()
    {
        if (auth()->user()->hasRole('Super-Admin')) {
            $appointments = Appointment::orderBy('schedule_id', 'desc')->get();
        } else if (auth()->user()->hasRole('Clinic Admin')) {
            $appointments = Appointment::where('clinic_id', auth()->user()->isClinicAdmin)->orderBy('schedule_id', 'desc')->get();
        } else if (auth()->user()->hasRole('Doctor')) {
            $appointments = Appointment::where('doctor_id', auth()->id())->orderBy('schedule_id', 'desc')->get();
        } else if (auth()->user()->hasRole('Receptionist')) {
            $appointments = Appointment::where('clinic_id', auth()->user()->clinic_id)->orderBy('schedule_id', 'desc')->get();
        }
        return view('admin.appointment.all', compact('appointments'));
    }

    public function past()
    {
        if (auth()->user()->hasRole('Super-Admin')) {
            $appointments = Appointment::orderBy('schedule_id', 'desc')->get();
        } else if (auth()->user()->hasRole('Clinic Admin')) {
            $appointments = Appointment::where('clinic_id', auth()->user()->isClinicAdmin)->orderBy('schedule_id', 'desc')->get();
        } else if (auth()->user()->hasRole('Doctor')) {
            $appointments = Appointment::where('doctor_id', auth()->id())->orderBy('schedule_id', 'desc')->get();
        } else if (auth()->user()->hasRole('Receptionist')) {
            $appointments = Appointment::where('clinic_id', auth()->user()->clinic_id)->orderBy('schedule_id', 'desc')->get();
        }
        return view('admin.appointment.past', compact('appointments'));
    }

    public function index()
    {
        if (auth()->user()->hasRole('Super-Admin')) {
            $appointments = Appointment::orderBy('schedule_id', 'desc')->where('status', '!=', 'Completed')->get();
        } else if (auth()->user()->hasRole('Clinic Admin')) {
            $appointments = Appointment::where('clinic_id', auth()->user()->isClinicAdmin)->where('status', '!=', 'Completed')->orderBy('schedule_id', 'desc')->get();
        } else if (auth()->user()->hasRole('Doctor')) {
            $appointments = Appointment::where('doctor_id', auth()->id())->where('status', '!=', 'Completed')->orderBy('schedule_id', 'desc')->get();
        } else if (auth()->user()->hasRole('Receptionist')) {
            $appointments = Appointment::where('clinic_id', auth()->user()->clinic_id)->where('status', '!=', 'Completed')->orderBy('schedule_id', 'desc')->get();
        }
        return view('admin.appointment.index', compact('appointments'));
    }

    public function create()
    {
        $services = Services::where('doctor_id', auth()->id())->where('status', '1')->pluck('name', 'id');
        $clinic = Clinic::where('status', '1')->pluck('name', 'id');
        $doctors = User::role('Doctor')->where('clinic_id', auth()->user()->isClinicAdmin)
            ->where('status', '1')
            ->get()
            ->pluck('full_name', 'id');
        if (auth()->user()->hasAnyRole('Super-Admin|Clinic Admin')) {
            $patients = User::where('type', '0')->where('clinic_id', auth()->user()->isClinicAdmin)
                ->where('status', '1')
                ->get()
                ->pluck('full_name', 'id');
        } else if (auth()->user()->hasRole('Receptionist')) {
            $patients = User::where('type', '0')->where('clinic_id', auth()->user()->clinic_id)
                ->where('status', '1')
                ->get()
                ->pluck('full_name', 'id');
            $doctors = User::role('Doctor')->where('clinic_id', auth()->user()->clinic_id)
                ->where('status', '1')
                ->get()
                ->pluck('full_name', 'id');
        } else if (auth()->user()->hasRole('Doctor')) {
            $patients = User::where('type', '0')->where('clinic_id', auth()->user()->clinic_id)
                ->where('status', '1')
                ->get()
                ->pluck('full_name', 'id');

            $schedule = Schedule::where('day', '>=', date('m/d/Y'))
                ->where('day', '!=', date('m/d/Y'))
                ->where('day', '!=',  date("m/d/Y", strtotime('tomorrow')))
                ->where('doctor_id', auth()->id())
                ->pluck('day', 'id');
            return view('admin.appointment.create', compact('clinic', 'doctors', 'patients', 'services', 'schedule'));
        }

        return view('admin.appointment.create', compact('clinic', 'doctors', 'patients', 'services'));
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
        $appointment->payment_option = 'Cash';

        $selectedTime = $request->time;
        $preferredTime = explode(" - ", $selectedTime);
        $appointment->start_time = $preferredTime[0];
        $appointment->end_time = $preferredTime[1];

        $appointment->save();

        $mailData = [
            'name' => $appointment->patients->full_name,
            'day' => $appointment->schedule->day,
            'start_time' => $appointment->start_time,
            'end_time' => $appointment->end_time,
            'status' => $appointment->status
        ];
        Mail::to($appointment->patients->email)->send(new MailAppointment($mailData));
        return redirect()->route('appointments.index')->with('success', 'Appointment added successfully');
    }

    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        $patients = User::where('type', '0')->where('status', '1')->get()->pluck('full_name', 'id');
        $clinic = Clinic::where('status', '1')->pluck('name', 'id');
        $doctor = User::role('Doctor')->where('status', '1')->where('clinic_id', $appointment->clinic_id)->get()->pluck('fullname', 'id');
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

        $appointment->schedule_id = $validatedData['schedule_id'];
        $appointment->description = $validatedData['description'];
        $appointment->status = $validatedData['status'];

        if (!empty($request->time)) {
            $selectedTime = $request->time;
            $preferredTime = explode(" - ", $selectedTime);
            $appointment->start_time = $preferredTime[0];
            $appointment->end_time = $preferredTime[1];
        }

        $appointment->save();

        if ($validatedData['status'] == 'Completed') {
            $treated = new Treated();
            $treated->app_id = $id;
            $treated->save();
        }

        if ($appointment->wasChanged()) {

            if ($validatedData['status'] == 'Booked' || $validatedData['status'] == 'Cancelled') {
                $mailData = [
                    'name' => $appointment->patients->full_name,
                    'day' => $appointment->schedule->day,
                    'start_time' => $appointment->start_time,
                    'end_time' => $appointment->end_time,
                    'status' => $appointment->status
                ];
                Mail::to($appointment->patients->email)->send(new MailAppointment($mailData));
            }
        }


        return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully');
    }

    public function getAppointmentDetails($id = 0)
    {

        $appointment = Appointment::find($id);

        $html = "";
        if (!empty($appointment)) {
            $html = "<tr>
                <td width='30%'><b>Date:</b></td>
                <td width='70%'> " . Carbon::parse($appointment->schedule->day)->toFormattedDateString() . "</td>
             </tr>
             <tr>
                <td width='30%'><b>Time:</b></td>
                <td width='70%'> " . $appointment->start_time . ' - ' . $appointment->end_time . "</td>
             </tr>
             <tr>
                <td width='30%'><b>Doctor:</b></td>
                <td width='70%'> " . $appointment->doctors->full_name . "</td>
             </tr>
             <tr>
                <td width='30%'><b>Patient:</b></td>
                <td width='70%'> " . $appointment->patients->full_name  . "</td>
             </tr>
             <tr>
                <td width='30%'><b>Clinic:</b></td>
                <td width='70%'> " . $appointment->clinic->name  . "</td>
             </tr>
             <tr>
                <td width='30%'><b>Description:</b></td>
                <td width='70%'> " . $appointment->description  . "</td>
             </tr>
             <tr>
                <td width='30%'><b>Service:</b></td>
                <td width='70%'> " . implode(',', $appointment->service)  . "</td>
             </tr>
             <tr>
                <td width='30%'><b>Payment option:</b></td>
                <td width='70%'> " . $appointment->payment_option  . "</td>
             </tr>
             <tr>
                <td width='30%'><b>Status:</b></td>
                <td width='70%'> " . $appointment->status . "</td>
             </tr>";
        }
        $response['html'] = $html;

        return response()->json($response);
    }

    public function getAmount(Request $request)
    {
        $id = $request->doctor_id;
        $amount = Services::where('id', $request->service_id)->where('doctor_id', $id)->get();
        return response()->json(["amount" => $amount]);
    }
}
