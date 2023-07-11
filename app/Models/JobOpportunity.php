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

}