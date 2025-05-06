<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Use string as primary key
    protected $primaryKey = 'category_id'; // Add this line
    protected $keyType = 'string';
    // Not auto-incrementing
    public $incrementing = false;    
}
