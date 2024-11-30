<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Job;

class JobSeeder extends Seeder
{
    public function run()
    {
        Job::create([
            'title' => 'Software Engineer',
            'location' => 'New York',
            'department' => 'Engineering',
            'description' => 'Develop and maintain web applications.'
        ]);

        Job::create([
            'title' => 'Project Manager',
            'location' => 'San Francisco',
            'department' => 'Management',
            'description' => 'Manage projects and coordinate teams.'
        ]);

        Job::create([
            'title' => 'Data Analyst',
            'location' => 'Remote',
            'department' => 'Data Science',
            'description' => 'Analyze data to extract insights.'
        ]);
    }
}

