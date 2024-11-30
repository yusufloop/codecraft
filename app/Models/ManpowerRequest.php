<?php

namespace App\Models;

use App\Models\User;
use App\Models\Department;
use Illuminate\Database\Eloquent\Model;

class ManpowerRequest extends Model
{
    protected $fillable = [ 'department_id',
    'position',
    'skills_required',
    'urgency',
    'status',
    'requested_by',
    'approved_by'];

    protected $table = 'manpower_request';
    
    #untuk dpeartment relation
    public function department() 
    {
        return $this->belongsTo(Department::class);
    }

    #untuk requeter
    public function requester()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    #untk approver
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
