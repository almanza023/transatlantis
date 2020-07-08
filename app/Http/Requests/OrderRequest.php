<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id_customer_domicile' => 'required|integer|exists:customer_domicile,id_customer_domicile',
            'id_type_payment' => 'required|integer|exists:type_payments,id_type_payment',
            'id_time_payment' => 'required|integer|exists:time_payments,id_time_payment',
            'id_product.*' => 'required|exists:products,id_product',
            'priority' => 'required|integer',
            'amount.*' => 'required',
            'unit_price.*' => 'required',
        ];

    }

    public function attributes()
    {
        return [
            'id_customer_domicile' => 'Cliente',
            'id_municipality' => 'Municipio',
            'id_type_payment' => 'Tipo de Pago',
            'id_time_payment' => 'Tiempo de Pago',
            'delivery_request' => 'Lugar de Entrega',
            'id_product.*' => 'Producto',
            'unit_price.*' => 'Precio',
            'amount.*' => 'Cantidad',
            'priority' => 'Prioridad',
        ];

    }

}
