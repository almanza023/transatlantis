<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nid' => 'required|integer',
            'id_type_customer' => 'required|integer|exists:type_customers,id_type_customer',
            'id_municipality' => 'required|integer|exists:municipalities,id_municipality',
            'full_name' => 'min:3|nullable',
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'address' => 'required|min:4',
            
            'email' => 'required|email',
            'contact_number' => 'required|integer',
        ];
    }

    public function attributes()
    {
        return [
            'nid' => 'Numero de Identificacion',
            'id_type_customer' => 'Tipo de Cliente',
            'id_municipality' => 'Municipio',
            'full_name' => 'Razon Social',
            'last_name' => 'Apellidos',
            'first_name' => 'Nombres',
            'address' => 'Dirección de Entrega',
           
            'email' => 'Correo Electronico',
            'contact_number' => 'Numero de Contacto',
        ];
    }

}
