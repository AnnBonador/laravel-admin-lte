<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClinicProfileRequest extends FormRequest
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
            'address' => 'required',
            'country' => 'required',
            'city' => 'required',
            'clinic_image' => 'sometimes|nullable|image|mimes:jpeg,gif,png,jpg|max:2048',

            'fname_admin' => 'required',
            'lname_admin' => 'required',
            'dob' => 'required',
            'email_admin' => 'required|email:rfc,dns|unique:users,email,' . auth()->id(),
            'gender' => 'required',
            'contact_admin' => ['required', 'regex:/^(09|\+639)\d{9}$/'],
            'admin_image' => 'sometimes|nullable|image|mimes:jpeg,gif,png,jpg|max:2048'

        ];
    }

    public function messages()
    {
        return [
            'specialization_id.required' => 'The specialization field is required',
            'email_admin.unique' => 'Email already exist'
        ];
    }
}
