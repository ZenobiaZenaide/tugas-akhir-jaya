<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids; // Add this import
use Illuminate\Database\Eloquent\Model;

class Slides extends Model // Or class Slide extends Model if that's the actual class name
{
    use HasUuids; // Add this trait

    
}
