<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorStoreRequest extends FormRequest
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
            'email' => 'required|email:rfc,dns|unique:users,email',
            'clinic_id' => 'required',
            'contact' => ['required', 'regex:/^(09|\+639)\d{9}$/'],
            'dob' => 'required|date_format:m/d/Y|before:today',
            'specialization_id' => 'required|array|min:1',
            'experience' => 'required',
            'gender' => 'required',
            'address' => 'required|max:255',
            'country' => 'required|max:255',
            'city' => 'required|max:255',
            'status' => 'required',
            'degree' => 'nullable',
            'college' => 'nullable',
            'about' => 'nullable',
            'latitude' => ['nullable','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'longitude' => ['nullable','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'year' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,gif,png,jpg|max:2048'
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
