<?php

namespace App\Models;

use App\Models\Orders; // Note: Consider if this should be Order::class
use Illuminate\Database\Eloquent\Concerns\HasUuids; // Add this import
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasUuids; // Add this trait


    public function order(){
        return $this->belongsTo(Orders::class, 'orders_id'); // Ensure 'Orders' class exists or change to 'Order' if needed
    }
}
