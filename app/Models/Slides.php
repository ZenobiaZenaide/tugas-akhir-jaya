<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Slides extends Model // Or class Slide extends Model if that's the actual class name
{
    // Use string as primary key
    protected $keyType = 'string';
    // Not auto-incrementing
    public $incrementing = false;    
}
