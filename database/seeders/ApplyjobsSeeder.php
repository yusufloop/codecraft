<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ApplyjobsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('applyjobs')->insert([
            [
                'title' => 'Software Developer',
                'description' => 'We are looking for a talented software developer to join our team.',
                'location' => 'New York, NY',
                'job_type' => 'full_time',
                'salary' => 80000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Project Manager',
                'description' => 'Join our team as a project manager to oversee various exciting projects.',
                'location' => 'San Francisco, CA',
                'job_type' => 'contract',
                'salary' => 90000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Graphic Designer',
                'description' => 'We are hiring a creative graphic designer to create stunning visuals.',
                'location' => 'Remote',
                'job_type' => 'part_time',
                'salary' => 40000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Internship - Data Analyst',
                'description' => 'Looking for a data analyst intern to help analyze data and generate insights.',
                'location' => 'Los Angeles, CA',
                'job_type' => 'internship',
                'salary' => 15000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }
}
