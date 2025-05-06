<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids; // Import HasUuids

class OrderItem extends Model
{
    use HasFactory;
    use HasUuids; // Add this trait to enable UUIDs for the primary key

    // Laravel 9+ automatically sets $incrementing to false and $keyType to 'string' 
    // when using HasUuids for the default 'id' primary key.
    // For older Laravel versions, or if your primary key is not named 'id',
    // you might need to explicitly set these:
    // public $incrementing = false;
    // protected $keyType = 'string';

    protected $fillable = [
        'product_id', 
        'order_id', 
        'price', 
        'quantity',
        'options',
        'rstatus'
        // 'id' is typically not mass assignable as it's a primary key
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function order(){
        return $this->belongsTo(Orders::class, 'order_id'); // Assumes Orders.id is the primary key it references
    }
}
