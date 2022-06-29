<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\ProductAsset;
use App\Models\User;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';   
    public $timestamps = false; 

    protected $fillable = [        
        'category_id',
        'name', 
        'slug',
        'price',
        'user_id'
    ];
    

    public function product_asset()
    {
        return $this->hasMany(ProductAsset::class);
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
