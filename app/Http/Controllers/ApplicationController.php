<?php

namespace App\Http\Controllers;

use App\Models\ApplyJob;
use App\Models\Application;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {
        $query = Application::query();

        // Sorting based on experience, education, or skill set
        if ($request->has('sort_by')) {
            switch ($request->sort_by) {
                case 'experience':
                    $query->orderBy('experience', 'desc');
                    break;
                case 'education':
                    $query->orderBy('education_level', 'asc');
                    break;
                case 'skills':
                    $query->orderByRaw('json_length(skills)');
                    break;
            }
        }

        $applications = $query->get();

        return view('applications.index', compact('applications'));
    }

    // Show form for applicants to submit an application
    public function create($jobId)
    {
        $job = ApplyJob::findOrFail($jobId);
        return view('applications.create', compact('job'));
    }

    // Store the submitted application
    public function store(Request $request)
    {
        $request->validate([
            'resume' => 'required|file|mimes:pdf,docx,doc|max:2048',
            'cover_letter' => 'nullable|string|max:5000',
            'skills' => 'nullable|array',
        ]);

        $resumePath = $request->file('resume')->store('resumes', 'public');

        $application = Application::create([
            'job_id' => $request->job_id,
            'applicant_id' => Auth::id(),
            'resume' => $resumePath,
            'cover_letter' => $request->cover_letter,
            'skills' => $request->skills,
            'status' => 'Pending',
        ]);

        return redirect()->route('applications.index')->with('success', 'Application submitted successfully!');
    }
}
