<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'clinic_id' => 'required',
            'doctor_id' => 'required',
            'patient_id' => 'required',
            'booking_id' => 'required',
            'appt_day' => 'required',
            'service' => 'required|array|min:1',
            'description' => 'nullable',
            'status' => 'required',
            'payment_option' => 'required',
        ];
    }
}
