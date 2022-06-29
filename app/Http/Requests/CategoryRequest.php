<?php

namespace App\Http\Requests;

use App\Traits\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class CategoryRequest extends ApiRequest
{
    public function authorize()
    {
        if ($this->method() == Request::METHOD_POST)
            return true;
        $category = $this->route('category');
        return auth()->user()->id == $category->user_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',            
        ];
    }
}
