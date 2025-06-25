<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Optional: if you use factories
use Illuminate\Database\Eloquent\Model; // Corrected namespace

class Brand extends Model
{


    protected $primaryKey = 'brand_id';
    public $incrementing = false;      
    protected $keyType = 'string';     

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'brand_id',
        'name',
        'slug',
        'image',
    ];
}
