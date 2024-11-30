<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\ApplyJob;
use App\Models\Application;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobAdvertisements = ApplyJob::all();
    $applicants = User::where('role', 'applicant')->get();

    // Log::info('Job Advertisements:', $jobAdvertisements->toArray());
    // Log::info('Applicants:', $applicants->toArray());

    foreach ($jobAdvertisements as $job) {
        foreach ($applicants as $applicant) {
            $resumePath = Storage::disk('public')->put('resumes', 'resume_' . $applicant->id . '.pdf');
            Application::create([
                'job_id' => $job->id,
                'applicant_id' => $applicant->id,
                'resume' => $resumePath,
                'cover_letter' => 'This is a cover letter for ' . $job->title,
                'skills' => json_encode(['PHP', 'Laravel', 'JavaScript']),
                'status' => 'Pending',
            ]);
        }
    }
    }
}
