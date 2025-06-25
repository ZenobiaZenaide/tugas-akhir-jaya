<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Add if you use factories

class Product extends Model
{

    protected $primaryKey = 'product_id'; 
    public $incrementing = false;      
    protected $keyType = 'string';    

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_id',
        'name',
        'slug',
        'short_description',
        'description',
        'regular_price',
        'sale_price',
        'SKU',
        'stock_status',
        'featured',
        'quantity',
        'image',
        'images',
        'category_id',
        'brand_id',
    ];

    public function category ()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function brand(){
        return $this->belongsTo(Brand::class, 'brand_id');
    }
}
