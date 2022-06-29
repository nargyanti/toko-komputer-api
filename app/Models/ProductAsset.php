<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\User;

class ProductAsset extends Model
{
    use HasFactory;

    protected $table = 'product_assets';    
    public $timestamps = false;

    protected $fillable = [        
        'product_id',
        'image',         
    ];    
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
