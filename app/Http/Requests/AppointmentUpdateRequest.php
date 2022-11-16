<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentUpdateRequest extends FormRequest
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
            'schedule_id' => 'required',
            'description' => 'nullable',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'schedule_id.required' => 'The schedule field is required',
        ];
    }
}
