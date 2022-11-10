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
            'email' => 'required|email:rfc,dns|unique:clinics,email',
            'contact' => ['required', 'regex:/^(09|\+639)\d{9}$/'],
            'specialization' => 'required',
            'status' => 'required',
            'address' => 'required',
            'country' => 'required',
            'city' => 'required'

        ];
    }
}
