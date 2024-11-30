<?php

namespace App\Models;

use App\Models\ManpowerRequest;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['name'];

    protected $table = 'departments';

    public function ManpowerRequest()
    {
        return $this->hasMany(ManpowerRequest::class);
    }
}
