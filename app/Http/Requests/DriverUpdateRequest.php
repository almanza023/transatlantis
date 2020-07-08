<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DriverUpdateRequest extends FormRequest
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
            'nid_driver' => 'required|integer|min:3',
            'first_name' => 'required|min:1',
            'last_name' => 'required|min:3',
            'address' => 'required|min:3',
            'email' => 'required|email',
            'contact_number' => 'required|integer|min:3',         
            'blood_type' => 'required',
            'date_birth' => 'required|date',
            'arl' => 'required',
           
        ];
    }

    public function attributes()
    {
        return [
            'nid_driver' => 'Numero de Identificación',
            'first_name' => 'Nombres',
            'last_name' => 'Apellidos',
            'address' => 'Dirección',
            'email' => 'Correo Electronico',
            'contact_number' => '# de Contacto',            
            'blood_type' => 'Tipo de Sangre',
            'date_birth' => 'Fecha de Nacimiento',            
            'arl' => 'ARL',            
        ];
    }
}
