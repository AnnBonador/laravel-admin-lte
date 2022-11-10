<?php

namespace App\Http\Requests;

use App\Rules\EndTimeRule;
use Illuminate\Foundation\Http\FormRequest;

class ScheduleStoreRequest extends FormRequest
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
            'doctor_id' => 'required',
            'clinic_id' => 'required',
            'duration' => 'required',
            'start_time' => 'required|before:end_time',
            'end_time' => 'required|after:start_time',
            'day' => 'required|after_or_equal:today',
        ];
    }

    public function messages()
    {
        return [
            'clinic_id.required' => 'The clinic field is required.',
            'doctor_id.required' => 'The doctor field is required.',
        ];
    }
}
