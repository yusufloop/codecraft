<?php

namespace App\Models;

use App\Models\ApplyJob;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'job_id',
        'applicant_id',
        'resume',
        'cover_letter',
        'skills',
        'status',
    ];

    protected $casts = [
        'skills' => 'array', // Automatically cast the skills as an array
    ];

    /**
     * Get the job advertisement associated with the application.
     */
    public function job()
    {
        return $this->belongsTo(ApplyJob::class, 'job_id');
    }

    /**
     * Get the applicant who submitted the application.
     */
    public function applicant()
    {
        return $this->belongsTo(User::class, 'applicant_id');
    }
}
