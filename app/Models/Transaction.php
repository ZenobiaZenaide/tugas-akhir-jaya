<?php

namespace App\Models;

use App\Models\Orders;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{


    public function order(){
        return $this->belongsTo(Orders::class, 'orders_id');
    }
}
