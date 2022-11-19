<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Clinic;
use App\Models\Schedule;
use App\Models\Services;
use App\Models\Appointment;
use App\Models\Transaction;
use App\Models\ReviewRating;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\ExpressCheckout;
use App\Http\Requests\User\AppointmentStoreRequest;
use App\Http\Requests\User\AppointmentUpdateRequest;

class AppointmentsController extends Controller
{
    public function index()
    {
        $appointments = Appointment::where('patient_id', Auth::id())->get();
        return view('user.appointment.index', compact('appointments'));
    }

    public function create()
    {
        $clinic = Clinic::where('id', Auth::user()->clinic_id)->where('status', '1')->pluck('name', 'id');
        return view('user.appointment.create', compact('clinic'));
    }

    public function store(AppointmentStoreRequest $request)
    {
        $validatedData = $request->validated();
        $appointment = new Appointment();

        $appointment->clinic_id = $validatedData['clinic_id'];
        $appointment->doctor_id = $validatedData['doctor_id'];
        $appointment->patient_id = Auth::id();
        $appointment->schedule_id = $validatedData['schedule_id'];
        $appointment->service = $validatedData['service'];
        $appointment->description = $validatedData['description'];
        $appointment->status = 'Booked';
        $appointment->payment_option = $validatedData['payment_option'];

        $selectedTime = $validatedData['time'];
        $preferredTime = explode(" - ", $selectedTime);
        $appointment->start_time = $preferredTime[0];
        $appointment->end_time = $preferredTime[1];

        $appointment->save();

        if ($request->payment_option == 'Paypal') {
            $fee = [];
            $fee['items'] = [
                [
                    'name' => Auth::user()->full_name,
                    'price' => 100
                ]
            ];

            $appPaypal = new Transaction();
            $appPaypal->appointment_id = $appointment->id;
            $appPaypal->doctor_id = $request->doctor_id;
            $appPaypal->clinic_id = $request->clinic_id;
            $appPaypal->patient_id = Auth::id();
            $appPaypal->reference_no = time() . '-' . Auth::user()->id;
            $appPaypal->amount = 100;
            $appPaypal->save();

            $fee['invoice_id'] = $appointment->id;
            $fee['invoice_description'] = "Appointment Fee #{$appointment->id}";
            $fee['return_url'] = route('success.payment');
            $fee['cancel_url'] = route('cancel.payment');
            $fee['total'] = 100;

            $provider = new ExpressCheckout();

            $res = $provider->setExpressCheckout($fee);
            $res = $provider->setExpressCheckout($fee, true);

            return redirect($res['paypal_link']);
        }

        return redirect()->route('user.appointments.index')->with('success', 'Appointment added successfully');
    }

    public function edit($id)
    {
        $appointment = Appointment::where('patient_id', Auth::id())->where('id', $id)->first();
        $clinic = Clinic::where('status', '1')->pluck('name', 'id');
        $doctor = User::where('type', '2')->where('status', '1')->where('clinic_id', $appointment->clinic_id)->get()->pluck('fullname', 'id');
        $service = Services::where('status', '1')->where('doctor_id', $appointment->doctor_id)->pluck('name');
        $schedule = Schedule::where('doctor_id', $appointment->doctor_id)->pluck('day', 'id');
        return view('user.appointment.edit', compact('clinic', 'appointment', 'doctor', 'service', 'schedule'));
    }

    public function destroy(Request $request)
    {
        $appointment = Appointment::find($request->delete_id);
        $appointment->delete();
        return redirect()->route('user.appointments.index')->with('success', 'Appointment deleted successfully');
    }

    public function update(AppointmentUpdateRequest $request, $id)
    {
        $validatedData = $request->validated();
        $appointment = Appointment::where('patient_id', Auth::id())->where('id', $id)->firstOrFail();

        $appointment->clinic_id = $validatedData['clinic_id'];
        $appointment->doctor_id = $validatedData['doctor_id'];
        $appointment->schedule_id = $validatedData['schedule_id'];
        $appointment->service = $validatedData['service'];
        $appointment->description = $validatedData['description'];

        if (!empty($request->time)) {
            $selectedTime = $request->time;
            $preferredTime = explode(" - ", $selectedTime);
            $appointment->start_time = $preferredTime[0];
            $appointment->end_time = $preferredTime[1];
        }

        $appointment->save();

        return redirect()->route('user.appointments.index')->with('success', 'Appointment updated successfully');
    }

    public function paymentCancel()
    {
        return redirect()->route('user.appointments.index')->with('Your payment has been declend. The payment cancelation page goes here!');
    }

    public function paymentSuccess(Request $request)
    {
        $provider = new ExpressCheckout;
        $response = $provider->getExpressCheckoutDetails($request->token);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            return redirect()->route('user.appointments.index')->with('success', 'Payment Successfull');
        }

        dd('Error occured!');
    }

    public function rateDoctor($id)
    {
        $appointment = Appointment::find($id);
        $review = ReviewRating::where('appointment_id', $id)->first();
        return view('user.appointment.rating.index', compact('appointment', 'review'));
    }

    public function usergetAppointmentDetails($id = 0)
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
                <td width='30%'><b>Status:</b></td>
                <td width='70%'> " . $appointment->status . "</td>
             </tr>";
        }
        $response['html'] = $html;

        return response()->json($response);
    }
}
