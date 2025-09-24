<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'name',
        'status', 
    ];

    public function translations()
    {
        return $this->morphMany(Translation::class, 'translatable');
    }
}
