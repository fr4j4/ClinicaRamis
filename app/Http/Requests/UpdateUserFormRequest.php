<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserFormRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name'=>'required',
            'rut'=>'unique:users',
            'email'=>'unique:users',
            'nickname'=>'unique:users',
            'password'=>'confirmed',
            'password_confirmation'=>'sometimes|required_with:password',
        ];
    }
}
