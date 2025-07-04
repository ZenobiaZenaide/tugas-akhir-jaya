<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $primaryKey = 'coupon_id'; 
    public $incrementing = false;    
    protected $keyType = 'string';     

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'coupon_id',
        'code',
        'type',
        'value',
        'cart_value',
        'expiry_date',
    ];
}
