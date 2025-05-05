<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Orders;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function order(){
        return $this->belongsTo(Order::class, 'orders_id');
    }
}
