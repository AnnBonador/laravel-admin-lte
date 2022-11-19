<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingsRequest extends FormRequest
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
            'title' => 'required',
            'footer' => 'required',
            'email' => 'required|email:rfc,dns',
            'logo' => 'sometimes|nullable|image|mimes:jpeg,gif,png,jpg',
            'favicon' => 'sometimes|nullable|image|mimes:jpeg,gif,png,jpg|max:2048',
            'fb' => 'nullable',
            'contact' => 'nullable'
        ];
    }
}
