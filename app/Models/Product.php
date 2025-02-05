<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name', 'price', 'units', 'description', 'image'
    ];
    
    public function orders(){
        return $this->hasMany(Order::class);
    }
    
    public function category(){
        return $this->belongsTo(Category::class);
    }
    
    public function images(){
        return $this->hasMany(ProductImage::class);
    }
}
