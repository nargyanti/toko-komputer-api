<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\ApiRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Exception\HttpResponseException;
use DB;

class CategoryController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $user = auth()->user();
        $category = Category::with('user')
            ->where('user_id', $user->id)
            ->get();

        return $this->apiSuccess($category);
    }

    public function sortByProductAmountDescending()
    {        
        $user = auth()->user();
        
        $category = DB::table('categories')
                        ->select(DB::raw('categories.id, categories.name, count(products.id) as amount'))
                        ->where('categories.user_id', $user->id)
                        ->join('products', 'products.category_id', '=', 'categories.id')
                        ->orderBy('amount', 'DESC')
                        ->groupBy('categories.id')
                        ->get();

        return $this->apiSuccess($category);
    }

    public function store(CategoryRequest $request)
    {        
        $user = auth()->user();     
        $request['user_id'] = $user->id;   

        $request->validated();
        $category = new Category($request->all());        
        $category->user()->associate($user);        
        $category->save();

        return $this->apiSuccess($category->load('user'));
    }

    public function show($id)
    {
        $category = Category::with('user')->find($id)->first();
        return $this->apiSuccess($category->load('user'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $request->validated();
        $category->name = $request->name;    
        $category->user_id = auth()->user()->id;  
        $category->save();
        return $this->apiSuccess($category->load('user'));
    }

    public function destroy($id)
    {
        $category = Category::where('id', $id)->first();
        if (auth()->user()->id == $category->user_id) {
            $category->delete();
            return $this->apiSuccess($category);
        }
        return $this->apiError(
            'Unauthorized',
            Response::HTTP_UNAUTHORIZED
        );
    }
}
