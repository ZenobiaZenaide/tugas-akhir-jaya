<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids; // Add this import
use App\Models\User;
use App\Models\OrderItem;
use App\Models\Transaction;


class Orders extends Model // Or class Order extends Model if that's the actual class name
{
    use HasUuids; // Add this trait


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
    

