<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobOpportunity extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'company_name',
        'location',
        'title',
        'slug',
        'description',
        'salary_range',
        'skills'
    ];

    public function applicants()
    {
        return $this->hasMany(JobSeeker::class);
    }

    public function scopeGetBySlug($query, $slug)
    {
        return $query->where('slug', $slug)->first();
    }
}
