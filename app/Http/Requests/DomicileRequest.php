<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DomicileRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'address' => 'required|min:4',
            'id_municipality' => 'required|integer|exists:municipalities,id_municipality',
            'contact_number' => 'required|integer',
        ];
    }

    public function attributes()
    {
        return [
            'id_municipality' => 'Municipio',
            'address' => 'Direccion',
            'contact_number' => 'Numero de Contacto',
        ];
    }
}
