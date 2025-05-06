<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories; // Consider adding HasFactory trait if needed

class Product extends Model
{
    // Use string as primary key
    protected $keyType = 'string';
    // Not auto-incrementing
    public $incrementing = false;

    public function category (){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function brand(){
        return $this->belongsTo(Brand::class, 'brand_id');
    }
}
