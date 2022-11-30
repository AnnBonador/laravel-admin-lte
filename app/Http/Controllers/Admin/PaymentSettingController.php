<?php

namespace App\Http\Controllers\Admin;

use App\Models\Clinic;
use Illuminate\Http\Request;
use App\Models\PaymentSetting;
use App\Http\Controllers\Controller;

class PaymentSettingController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('Super-Admin')) {
            $paypal = PaymentSetting::all();
        } else if (auth()->user()->hasRole('Clinic Admin')) {
            $paypal = PaymentSetting::where('clinic_id', auth()->user()->isClinicAdmin)->get();
        } else if (auth()->user()->hasRole('Receptionist')) {
            $paypal = PaymentSetting::where('clinic_id', auth()->user()->clinic_id)->get();
        }
        return view('admin.payment-settings.index', compact('paypal'));
    }

    public function create()
    {
        $clinic = Clinic::where('status', '1')->pluck('name', 'id');
        return view('admin.payment-settings.create', compact('clinic'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'clinic_id' => 'required',
            'username' => 'required',
            'password' => 'required',
            'currency' => 'required',
            'secret' => 'required'
        ]);
        PaymentSetting::create($validatedData);

        return redirect()->route('paypal.index')->with('success', 'Paypal added successfully');
    }

    public function edit($id)
    {
        $paypal = PaymentSetting::findOrFail($id);
        $clinic = Clinic::where('status', '1')->pluck('name', 'id');
        return view('admin.payment-settings.edit', compact('paypal', 'clinic'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'clinic_id' => 'required',
            'username' => 'required',
            'password' => 'required',
            'currency' => 'required',
            'secret' => 'required'
        ]);
        $paypal = PaymentSetting::findOrFail($id);
        $paypal->update($validatedData);

        return redirect()->route('paypal.index')->with('success', 'Paypal updated successfully');
    }

    public function destroy(Request $request)
    {
        $paypal = PaymentSetting::find($request->delete_id);
        $paypal->delete();
        return redirect()->route('paypal.index')->with('success', 'Paypal deleted successfully');
    }
}
