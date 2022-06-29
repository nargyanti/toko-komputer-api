<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ApiRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use App\Traits\ApiResponse;
use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $user = auth()->user();
        $product = Product::with('user', 'category', 'product_asset')
            ->where('user_id', $user->id)
            ->get();

        return $this->apiSuccess($product);
    }

    public function sortByPriceDescending() 
    {
        $user = auth()->user();
        $product = Product::with('user', 'category', 'product_asset')
            ->where('user_id', $user->id)
            ->orderBy('price', 'DESC')
            ->get();

        return $this->apiSuccess($product);
    }


    public function store(ProductRequest $request)
    {
        $request['slug'] = Str::slug($request->name);
        $request->validated();

        $product = new Product($request->all());    

        $user = auth()->user();        
        $category = Category::where('id', $request->category_id)->first();
        $product->user()->associate($user);
        $product->category()->associate($category);

        $product->save();

        return $this->apiSuccess($product);
    }

    public function show($id)
    {
        $product = Product::with('user', 'category', 'product_asset')->find($id)->first();
        return $this->apiSuccess($product);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $request['slug'] = Str::slug($request->name);
        $request->validated();
        
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->price = $request->price;
        
        $user = auth()->user();        
        $category = Category::where('id', $request->category_id)->first();
        $product->user()->associate($user);
        $product->category()->associate($category);

        $product->save();
        return $this->apiSuccess($product);
    }

    public function destroy($id)
    {
        $product = Product::with('user', 'category')->find($id)->first();
        if (auth()->user()->id == $product->user_id) {
            $product->delete();            
            return $this->apiSuccess($product);
        }
        return $this->apiError(
            'Unauthorized',
            Response::HTTP_UNAUTHORIZED
        );
    }
}
