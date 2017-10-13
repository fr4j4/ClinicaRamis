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
    /*asegurarse de pasar la id del usuario con nombre "uid" en el input oculto*/
    public function rules()
    {
        return [
            'name'=>'required',
            'rut'=>'nullable|unique:users',
            'email'=>'unique:users,email,'.$this->uid,
            'alias'=>'unique:users,nickname,'.$this->uid,
            'password'=>'confirmed',
            'password_confirmation'=>'sometimes|required_with:password',
        ];
    }
}
