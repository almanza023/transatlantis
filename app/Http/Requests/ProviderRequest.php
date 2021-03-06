<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProviderRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {

        return [
            'nit' => 'required|integer',
            'id_type_provider' => 'required|integer|exists:type_providers,id_type_provider',
            'id_municipality' => 'required|integer|exists:municipalities,id_municipality',
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'address' => 'required|min:4',
            'email' => 'required|email|unique:providers,email',
            'contact_number' => 'required|integer'
        ];
    }

    public function attributes()
    {
        return [
            'id_type_provider' => 'Tipo Proveedor',
            'id_municipality' => 'Municipio',
            'last_name' => 'Apellido del Representante de Proveedor',
            'first_name' => 'Nombre del Representante de  Proveedor',
            'address' => 'Direccion',
            'email' => 'Correo Electronico',
            'contact_number' => 'Numero de Contacto'
        ];
    }
}
