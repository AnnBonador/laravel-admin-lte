<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TreatedRequest extends FormRequest
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
            'teeth' => 'required',
            'problem' => 'required',
            'fee' => 'required',
            'remarks' => 'required',
            'status' => 'required',
            'file' => 'sometimes|mimes:csv,txt,xlx,xls,pdf|max:2048'
        ];
    }
}
