<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Slides extends Model
{
    protected $primaryKey = 'slide_id'; // Specify the new primary key
    public $incrementing = false;       // Indicate that the primary key is not auto-incrementing
    protected $keyType = 'string';      // Indicate that the primary key is a string

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'slide_id',
        'tagline',
        'title',
        'subtitle',
        'link',
        'image',
        'status',
    ];
}
