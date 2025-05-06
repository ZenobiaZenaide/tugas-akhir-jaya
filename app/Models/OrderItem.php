<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Orders; // Note: Consider if this should be Order::class
use Illuminate\Database\Eloquent\Concerns\HasUuids; // Add this import
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasUuids; // Add this trait

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function order(){
        return $this->belongsTo(Orders::class, 'order_id'); // Uses 'order_id'
    }
}
