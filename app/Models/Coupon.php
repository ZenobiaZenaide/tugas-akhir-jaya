<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    // Use string as primary key
    protected $keyType = 'string';
    // Not auto-incrementing
    public $incrementing = false;
}
