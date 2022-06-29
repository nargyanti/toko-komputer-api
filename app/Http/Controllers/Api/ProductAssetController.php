<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductAssetRequest;
use App\Http\Requests\ApiRequest;
use Illuminate\Http\Request;
use App\Models\ProductAsset;
use App\Models\Product;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Exception\HttpResponseException;

class ProductAssetController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $user = auth()->user();
        $product_asset = ProductAsset::with('user', 'product')
            ->where('user_id', $user->id)
            ->get();

        return $this->apiSuccess($product_asset);
    }

    public function store(ProductAssetRequest $request)
    {
        $user = auth()->user();
        $request['user_id'] = $user->id;
        $product = Product::where('id', $request->product_id)->first();

        $request->validated();                
        $request->file('image')->storeAs('images', $request->image->getClientOriginalName());

        $product_asset = new ProductAsset();
        $product_asset->image = $request->image->getClientOriginalName();
        $product_asset->product_id = $request->product_id;
        
        $product_asset->user()->associate($user);
        $product_asset->product()->associate($product);
        $product_asset->save();

        return $this->apiSuccess($product_asset->load('user', 'product'));
    }

    public function show($id)
    {
        $product_asset = ProductAsset::where('id', $id)->first();
        return $this->apiSuccess($product_asset->load('user', 'product'));
    }
    
    public function destroy($id)
    {
        $product_asset = ProductAsset::where('id', $id)->first();
        if (auth()->user()->id == $product_asset->user_id) {
            $product_asset->delete();
            return $this->apiSuccess($product_asset);
        }
        return $this->apiError(
            'Unauthorized',
            Response::HTTP_UNAUTHORIZED
        );
    }
}
