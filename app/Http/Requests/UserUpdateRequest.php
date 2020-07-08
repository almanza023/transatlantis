<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [            
            'first_name' => 'required',
            'last_name' => 'required|min:3',            
            'address' => 'required|min:4',
            'rol_id' => 'required|integer',            
            'email' => 'required|email',
            'contact_number' => 'required|integer',
        ];
    }

    public function attributes()
    {
        return [                        
            'last_name' => 'Apellidos',
            'first_name' => 'Nombres',
            'address' => 'Direccion',          
            'email' => 'Correo Electronico',
            'rol_id' => 'Rol ',
            'contact_number' => 'Numero de Télefono',
        ];
    }

}
