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
            'schedule_id' => 'required',
            'time' => 'required',
            'service' => 'required|array|min:1',
            'description' => 'nullable',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'clinic_id.required' => 'The clinic field is required',
            'doctor_id.required' => 'The doctor field is required',
            'patient_id.required' => 'The patient field is required',
            'schedule_id.required' => 'The schedule field is required',
            'time.required' => 'Select a time slot'
        ];
    }
}
