<?php

namespace App\Http\Requests;

use App\Traits\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class ProductAssetRequest extends ApiRequest
{
    public function authorize()
    {
        if ($this->method() == Request::METHOD_POST)
            return true;
        $product_asset = $this->route('product_asset');
        return auth()->user()->id == $product_asset->user_id;
    }

    public function rules()
    {
        return [            
            'image' => 'required|mimes:jpg,bmp,png',            
        ];
    }
}
