<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\OrderItem;
use App\Models\Transaction;


class Orders extends Model
{


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function orderitems(){
        return $this->hasMany(OrderItem::class);
    }

    public function transaction(){
        return $this->hasOne(Transaction::class);
    }
}
    

