<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'qualification_id',
        'job_id',
        'city_id', 
        'name',
        'birth_date',
        'graduate_date',
        'address',
        'phone',
        'experiences',
        'current_job',
        'courses',
        'expected_salary',
        'university',
        'collage',
        'marital',
        'children',
        'upload_cv',
        'link',
        'favourite',
    ];
    protected $appends = ['cv_link'];
 
    public function getCvLinkAttribute(){
        return url('storage/' . $this->attributes['upload_cv']);
    }
 
    public function qualification(){
        return $this->belongsTo(Qualification::class, 'qualification_id');
    }


    public function job(){
        return $this->belongsTo(Job::class, 'job_id');
    }

    public function city(){
        return $this->belongsTo(City::class, 'city_id');
    }
}
