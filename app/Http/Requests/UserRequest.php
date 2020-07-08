<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'document' => 'required|min:3|unique:admins,document',
            'address' => 'required|min:4',
            'rol_id' => 'required|integer',
            'password' => 'required|min:5',
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
            'document' => 'N° Documento',
            'password' =>'Contraseña',
            'email' => 'Correo Electronico',
            'rol_id' => 'Rol ',
            'contact_number' => 'Numero de Télefono',
        ];
    }

}
