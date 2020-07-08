<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscountRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {
        return [
            'discount' => 'required|integer',
        ];
    }

    public function attributes()
    {
        return [
            'discount' => 'Descuento',
        ];
    }
}
