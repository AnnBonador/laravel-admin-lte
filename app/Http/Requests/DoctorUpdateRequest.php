<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorUpdateRequest extends FormRequest
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
            'email' => 'required|email:rfc,dns|unique:users,email,' . $this->id,
            'clinic_id' => 'required',
            'contact' => ['required', 'regex:/^(09|\+639)\d{9}$/'],
            'dob' => 'required|date_format:m/d/Y|before:today',
            'specialization_id' => 'required|max:255',
            'experience' => 'required',
            'gender' => 'required',
            'address' => 'nullable|max:255',
            'country' => 'nullable|max:255',
            'city' => 'nullable|max:255',
            'status' => 'required',
            'degree' => 'nullable',
            'college' => 'nullable',
            'about' => 'nullable',
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
            'specialization_id.required' => 'The specialization field is required.',
        ];
    }
}
