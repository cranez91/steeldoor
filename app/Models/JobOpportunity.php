<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobOpportunity extends Model
{
    use SoftDeletes, HasFactory;
    
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

    /**
     * Get the current connection name for the model.
     *
     * @return string
     */
    public function getConnectionName()
    {
        $connection = 'mysql';
        if (app()->environment('testing'))
            $connection = 'sqlite';

        return $connection;
    }
}
