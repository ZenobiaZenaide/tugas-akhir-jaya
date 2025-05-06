<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Optional: if you use factories
use Illuminate\Database\Eloquent\Model; // Corrected namespace

class Brand extends Model
{
    // use HasFactory; // Optional: if you use factories

    protected $primaryKey = 'brand_id'; // Specify the new primary key
    public $incrementing = false;       // Indicate that the primary key is not auto-incrementing
    protected $keyType = 'string';      // Indicate that the primary key is a string

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

    // Define any relationships here, for example, if a Brand has many Products:
    // public function products()
    // {
    //     return $this->hasMany(Product::class, 'brand_id', 'brand_id');
    // }
}
