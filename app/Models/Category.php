<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\User;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';    
    public $timestamps = false;

    protected $fillable = [        
        'name',                
    ];

    public function product()
    {
        return $this->hasMany(Product::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
