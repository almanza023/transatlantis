<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {
        return [
            'id_type_unit' => 'required|integer|exists:type_units,id_type_unit',
            'id_category' => 'required|integer|exists:categories,id_category',
            'name_product' => 'required|min:3',
            'description' => 'required|min:3',
            'type_price' => 'required|integer',
            'weight' => 'integer|nullable',
            'volume' => 'integer|nullable',
            'price' => 'integer|required|min:3',
            'effective_date' => 'date|nullable'
        ];
    }

    public function attributes()
    {
        return [
            'id_type_unit' => 'Tipo de Unidad',
            'id_category' => 'Categoria',
            'name_product' => 'Nombre del Producto',
            'description' => 'Descripción',
            'type_price' => 'Tipo de Precio',
            'weight' => 'Peso',
            'volume' => 'Volumen',
            'price' => 'Precio',
            'effective_date' => 'Fecha de Vigencia'
        ];
    }
}
