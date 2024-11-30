<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplyJob extends Model
{
    use HasFactory;

    protected $table = 'Applyjobs';
    protected $fillable = ['title', 'description', 'location', 'job_type', 'salary'];
}
