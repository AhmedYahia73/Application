<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'name',
        'status',
        'link_name',
    ];

    public function translations()
    {
        return $this->morphMany(Translation::class, 'translatable');
    }
}
