<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceStoreRequest extends FormRequest
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
            'service_cid' => 'required',
            'name' => 'required',
            'charges' => 'required|numeric',
            'doctor_id' => 'required',
            'status' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'service_cid.required' => 'The service field is required.',
            'doctor_id.required' => 'The doctor field is required.',
        ];
    }
}
