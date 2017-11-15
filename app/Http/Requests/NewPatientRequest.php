<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewPatientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        return [
            'firstname'=>'required',
            'lastname'=>'required',
            'rut'=>array(
                'unique:patients',
                'required',
                'regex:/^\d{1,3}.?\d{3}.?\d{3}-([1-9]|k){1}$/'
            ),
            //'rut'=>'required|unique:patients|regex',
        ];
    }
}
