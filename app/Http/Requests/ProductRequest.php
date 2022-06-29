<?php

namespace App\Http\Requests;

use App\Traits\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class ProductRequest extends ApiRequest
{

    public function authorize()
    {
        if ($this->method() == Request::METHOD_POST)
            return true;
        $product = $this->route('product');
        return auth()->user()->id == $product->user_id;
    }

    public function rules()
    {
        return [            
            'name' => 'required|string|max:255',            
            'price' => 'required|integer'
        ];
    }
}
