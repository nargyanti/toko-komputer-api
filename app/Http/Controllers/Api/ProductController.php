<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ApiRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductAsset;
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
        $product = Product::with('product_asset')
            ->where('user_id', $user->id)
            ->get();

        return $this->apiSuccess($product);
    }

    public function sortByPriceDescending() 
    {
        $user = auth()->user();
        $product = Product::with('product_asset')
            ->where('user_id', $user->id)
            ->orderBy('price', 'DESC')
            ->get();

        return $this->apiSuccess($product);
    }


    public function store(ProductRequest $request)
    {
        $user = auth()->user();    

        $request['slug'] = Str::slug($request->name);
        $request['user_id'] = $user->id;
        
        $request->validated();
        $product = new Product($request->all());    
            
        $category = Category::where('id', $request->category_id)->first();
        $product->user()->associate($user);
        $product->category()->associate($category);

        $product->save();

        if($request->hasfile('image')) {
            foreach($request->file('image') as $image)
            {            
                $image->storeAs('images', $image->getClientOriginalName());
        
                $product_asset = new ProductAsset();
                $product_asset->image = $image->getClientOriginalName();
                $product_asset->product_id = $product->id;
                
                $product_asset->user()->associate($user);
                $product_asset->product()->associate($product);
                $product_asset->save();                        
            }                    
        }        
        return $this->apiSuccess($product->load('product_asset'));
    }

    public function show($id)
    {
        $product = Product::with('product_asset')->find($id)->first();
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
        return $this->apiSuccess($product->load('product_asset'));
    }

    public function destroy($id)
    {
        $product = Product::where('id', $id)->first();
        if (auth()->user()->id == $product->user_id) {
            $product->delete();            
            return $this->apiSuccess($product->load('product_asset'));
        }
        return $this->apiError(
            'Unauthorized',
            Response::HTTP_UNAUTHORIZED
        );
    }
}
