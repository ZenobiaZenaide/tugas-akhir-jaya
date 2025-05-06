<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 
        'order_id', 
        'price', 
        'quantity',
        'options',
        'rstatus'
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'product_id'); // Ensure 'product_id' is the foreign key and 'product_id' is the owner key in products table
    }

    public function order(){
        return $this->belongsTo(Orders::class, 'order_id');
    }
}
