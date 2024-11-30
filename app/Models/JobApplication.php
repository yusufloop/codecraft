<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
        
        class JobApplication extends Model
        {
            use HasFactory;
        
            // Fields that are mass assignable
            protected $fillable = ['job_id', 'name', 'age', 'phone_no', 'address', 'email', 'resume_path','status','experience','education','skill_set'];
        
            // Define the relationship to the Job model
            public function job()
            {
                return $this->belongsTo(Job::class);
            }
        }
        
    

