<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory, HasUuids;

    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the orderitems for the Orders
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderitems() // Or whatever you named this relationship method
    {
        // Ensure the foreign key here is 'order_id'
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    public function transaction(){
        return $this->hasOne(Transaction::class, 'order_id', 'id'); // Specify 'order_id' as the foreign key
    }
}
    

