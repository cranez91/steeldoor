<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobSeeker extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name',
        'email',
        'resume',
        'job_opportunity_id'
    ];

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
