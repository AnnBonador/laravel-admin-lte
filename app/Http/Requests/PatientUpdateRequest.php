<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientUpdateRequest extends FormRequest
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
            'fname' => 'required|max:255',
            'lname' => 'required|max:255',
            'email' => 'required|email:rfc,dns|unique:patients,email,' . $this->id,
            'clinic_id' => 'required',
            'contact' => 'required',
            'dob' => 'required|date_format:m/d/Y|before:today',
            'gender' => 'required',
            'address' => 'nullable|max:255',
            'country' => 'nullable|max:255',
            'city' => 'nullable|max:255',
            'status' => 'required',
            'image' => 'sometimes|nullable|image|mimes:jpeg,gif,png,jpg|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'fname.required' => 'The first name field is required.',
            'lname.required' => 'The last name field is required.',
            'clinic_id.required' => 'The clinic field is required.',
            'dob.required' => 'The birthday field is required.',
        ];
    }
}
