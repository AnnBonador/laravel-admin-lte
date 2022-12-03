<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Clinic;
use App\Models\Service;
use App\Models\Schedule;
use App\Models\Appointment;
use App\Models\Transaction;
use App\Models\ReviewRating;
use Illuminate\Http\Request;
use App\Models\PaymentSetting;
use App\Models\AppointmentService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
use Srmklive\PayPal\Services\ExpressCheckout;
use App\Http\Requests\User\AppointmentStoreRequest;
use App\Http\Requests\User\AppointmentUpdateRequest;
use App\Mail\Appointment as MailAppointment;
use App\Mail\UserAppointmentMail;

class AppointmentsController extends Controller
{
    public function index()
    {
        $appointments = Appointment::where('patient_id', Auth::id())->get();
        return view('user.appointment.index', compact('appointments'));
    }

    public function createStepOne(Request $request)
    {
        $app = $request->session()->get('app');
        $clinic = Clinic::where('status', '1')->pluck('name', 'id');
        return view('user.appointment.create', compact('clinic', 'app'));
    }

    public function postCreateStepOne(AppointmentStoreRequest $request)
    {
        $validatedData = $request->validated();

        if (empty($request->session()->get('product'))) {
            $app_service = new AppointmentService();
            $appointment = new Appointment();
            $validatedData['patient_id'] = Auth::id();
            $validatedData['status'] = 'Booked';
            $service_app = $validatedData['service'];
            $selectedTime = $validatedData['time'];
            $preferredTime = explode(" - ", $selectedTime);
            $validatedData['start_time']  = $preferredTime[0];
            $validatedData['end_time'] = $preferredTime[1];
            $app = $appointment->fill($validatedData);

            $app_service->fill(array(
                'appointment_id' => $app->id,
                'service_id' => $service_app
            ));

            $request->session()->put('app', $app);
            $request->session()->put('app_service', $app_service);
        } else {
            $app = $request->session()->get('app');
            $app->fill($validatedData);
            $request->session()->put('app', $app);
        }


        return redirect()->route('user.appointments.create.step.two');
    }

    public function createStepTwo(Request $request)
    {
        $app = $request->session()->get('app');
        $app_service = $request->session()->get('app_service');

        $collection = json_decode($app_service);
        $ids = $collection->service_id;
        $app_service = Service::whereIn('id', $ids)->get();

        return view('user.appointment.summary', compact('app', 'app_service'));
    }

    public function postCreateStepTwo(Request $request)
    {
        $validatedData = $request->validate([
            'payment_option' => 'required',
        ]);

        $app = $request->session()->get('app');
        $app_service = $request->session()->get('app_service');
        if ($request->payment_option == 'Cash') {
            $app->payment_option = $validatedData['payment_option'];
            $app->save();

            $collection = json_decode($app_service);
            $ids = $collection->service_id;
            foreach ($ids as $data) {
                AppointmentService::create([
                    'appointment_id' => $app->id,
                    'service_id' => $data
                ]);
            }
            $mailData = [
                'name' => $app->doctors->full_name,
                'day' => $app->schedule->day,
                'start_time' => $app->start_time,
                'end_time' => $app->end_time,
                'status' => $app->status
            ];
            Mail::to($app->patients->email)->send(new UserAppointmentMail($mailData));

            $request->session()->forget('app');

            return redirect()->route('user.appointments.index');
        } else {
            $request->session()->put('app', $app);
            $request->session()->put('app_service', $app_service);
            $request->session()->put('payment', $app_service);
            $request->session()->put('payment_option', $validatedData['payment_option']);

            return redirect()->route('user.appointments.step.three');
        }
    }

    public function createStepThree(Request $request)
    {
        $app = $request->session()->get('app');
        $app_service = $request->session()->get('app_service');
        $payment_option = $request->session()->get('payment_option');

        $collection = json_decode($app_service);
        $ids = $collection->service_id;
        $app_service = Service::whereIn('id', $ids)->get();

        return view('user.appointment.checkout', compact('app', 'app_service'));
    }

    /**
     * Show the step One Form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function postCreateStepThree(Request $request)
    {
        $app = $request->session()->get('app');
        $app_service = $request->session()->get('app_service');
        $payment_option = $request->session()->get('payment_option');

        // //get amount
        $collection = json_decode($app_service);
        $ids = $collection->service_id;
        $app_service = Service::whereIn('id', $ids)->get();
        $price = $app_service->sum('charges');

        // //invoice no.
        $latest = Transaction::latest()->first();

        if (!$latest) {
            $inv =  'INV0001';
        } else {
            $string = preg_replace("/[^0-9\.]/", '', $latest->invoice);
            $inv = 'INV' . sprintf('%04d', $string + 1);
        }

        $fee = [];
        $fee['items'] = [
            [
                'name' => Auth::user()->full_name,
                'price' => $price
            ]
        ];

        $fee['invoice_id'] = $inv;
        $fee['invoice_description'] = "Appointment Fee #{$inv}";
        $fee['return_url'] = route('success.payment');
        $fee['cancel_url'] = route('cancel.payment');
        $fee['total'] = $price;

        $provider = new ExpressCheckout();

        $res = $provider->setExpressCheckout($fee);
        $res = $provider->setExpressCheckout($fee, true);

        return redirect($res['paypal_link']);

        $request->session()->put('app', $app);
        $request->session()->put('app_service', $app_service);
        $request->session()->put('payment_option', $payment_option);

        return redirect()->route('user.appointments.index');
    }


    public function edit($id)
    {
        $appointment = Appointment::with('services')->where('patient_id', Auth::id())->where('id', $id)->first();
        $app = $appointment->services->pluck('id')->toArray();
        $clinic = Clinic::where('status', '1')->pluck('name', 'id');
        $doctor = User::role('Doctor')->where('status', '1')->where('clinic_id', $appointment->clinic_id)->get()->pluck('fullname', 'id');
        $service = Service::where('status', '1')->where('doctor_id', $appointment->doctor_id)->get();
        $schedule = Schedule::where('doctor_id', $appointment->doctor_id)->pluck('day', 'id');
        return view('user.appointment.edit', compact('app', 'clinic', 'appointment', 'doctor', 'service', 'schedule'));
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

            $app = $request->session()->get('app');
            $payment_option = $request->session()->get('payment_option');
            $app->payment_option = $payment_option;
            $app->save();

            $app_service = $request->session()->get('app_service');
            $collection = json_decode($app_service);
            $ids = $collection->service_id;
            foreach ($ids as $data) {
                AppointmentService::create([
                    'appointment_id' => $app->id,
                    'service_id' => $data
                ]);
            }
            $collection = json_decode($app_service);
            $ids = $collection->service_id;
            $app_service = Service::whereIn('id', $ids)->get();
            $price = $app_service->sum('charges');
            $latest = Transaction::latest()->first();

            if (!$latest) {
                $inv =  'INV0001';
            } else {
                $string = preg_replace("/[^0-9\.]/", '', $latest->invoice);
                $inv = 'INV' . sprintf('%04d', $string + 1);
            }

            $input['appointment_id'] = $app->id;
            $input['doctor_id'] = $app->doctor_id;
            $input['clinic_id'] = $app->clinic_id;
            $input['patient_id'] =  Auth::id();
            $input['reference_no'] =  time() . '-' . Auth::user()->id;
            $input['amount'] =  $price;
            $input['invoice'] =  $inv;
            Transaction::create($input);

            $request->session()->forget('app');
            $request->session()->forget('app_services');
            $request->session()->forget('inv');
            $request->session()->forget('payment_option');

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
        $appointment = Appointment::with('services')->where('id', $id)->first();
        $services = $appointment->services->pluck('name')->toArray();

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
                <td width='70%'> " . implode(',', $services)  . "</td>
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
