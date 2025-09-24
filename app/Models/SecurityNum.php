<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SecurityNum extends Model
{
    protected $fillable = [
        'number',
        'status', 
    ];
}
