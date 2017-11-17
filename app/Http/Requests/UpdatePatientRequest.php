<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


use Illuminate\Support\Facades\Storage;

class UpdatePatientRequest extends FormRequest
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
            'rut'=>array(
                'unique:patients',
                'required',
                'regex:/^\d{1,3}.?\d{3}.?\d{3}-([1-9]|k){1}$/'
            ),
            'email'=>'sometimes|email|nullable',
            'name'=>'required:patients',
            'lastname'=>'required:patients',
        ];
    }
}
