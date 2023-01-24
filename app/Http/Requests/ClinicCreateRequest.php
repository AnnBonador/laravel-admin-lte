<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClinicCreateRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email:rfc,dns',
            'contact' => ['required', 'regex:/^(09|\+639)\d{9}$/'],
            'specialization_id' => 'required|array|min:1',
            'status' => 'required',
            'address' => 'required',
            'country' => 'required',
            'city' => 'required',
            'latitude' => ['nullable','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'longitude' => ['nullable','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'clinic_image' => 'nullable|image|mimes:jpeg,gif,png,jpg|max:2048',

            'fname_admin' => 'required',
            'lname_admin' => 'required',
            'dob' => 'required',
            'email_admin' => 'required',
            'gender' => 'required',
            'contact_admin' => ['required', 'regex:/^(09|\+639)\d{9}$/'],
            'admin_image' => 'nullable|image|mimes:jpeg,gif,png,jpg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'dob.required' => 'The birthday field is required',
            'fname_admin.required' => 'First name field is required',
            'lname_admin.required' => 'Last name field is required',
        ];
    }
}
