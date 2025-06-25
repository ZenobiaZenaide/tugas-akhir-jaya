<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids; // Import HasUuids

class OrderItem extends Model
{
    use HasFactory;
    use HasUuids; 


    protected $fillable = [
        'product_id', 
        'order_id', 
        'price', 
        'quantity',
        'options',
        'rstatus'
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function order(){
        return $this->belongsTo(Orders::class, 'order_id'); 
    }
}
