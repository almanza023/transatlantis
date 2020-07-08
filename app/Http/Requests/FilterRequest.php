<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'filter_priority' => 'required|integer|between:1,95',
            'filter_status' => '',
            'filter_date' => '',
        ];
    }

    public function attributes()
    {
        return [
            'discount' => 'Descuento',
        ];
    }
}
