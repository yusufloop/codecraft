<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(Request $request)
    {
// Get the search field and search term from the input
$searchField = $request->input('search_field');
$searchTerm = $request->input('search');
$sortField = $request->input('sort_field', 'title'); // Default to 'title'
$sortOrder = $request->input('sort_order', 'asc');   // Default to 'asc'

// Query the jobs and filter them based on the search criteria
$jobs = Job::query();

// Apply search filter based on the selected "Search by" field
if ($searchField && $searchTerm) {
    $jobs = $jobs->where($searchField, 'like', "%$searchTerm%");
}

// Apply sorting
$jobs = $jobs->orderBy($sortField, $sortOrder)->get();

// Return the view with jobs and filter options
return view('joblists.index', compact('jobs'));
    }

    // Display the job application form
    public function applyForm(Job $job)
    {
        return view('jobs.apply', compact('job'));
    }

    // Handle the job application submission (file upload and data save)
    public function apply(Request $request, Job $job)
    {
        // Validate the form data, including the resume upload
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'ic_num' => 'string',
            'age' => 'string',
            'phone_no' => 'string',
            'address' => 'string',
            'email' => 'required|email|max:255',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048', // Validate file type and size (max 2MB)
        ]);

        // Store the resume file
        $resumePath = $request->file('resume')->store('resumes', 'public'); // Store in 'resumes' folder

        // Store the job application in the database
        $job->applications()->create([
            'name' => $validated['name'],
            'age' => $validated['age'],
            'phone_no' => $validated['phone_no'],
            'address' => $validated['address'],
            'email' => $validated['email'],
            'resume_path' => $resumePath,
        ]);

        // Redirect back with success message
        return redirect()->route('joblists.index')->with('success', 'Your application has been submitted successfully!');
    }

    // Update the status of a job application
    public function updateStatus(Request $request, JobApplication $application)
    {
        // Validate the status input
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        // Update the status
        $application->update([
            'status' => $request->input('status'),
        ]);

        return redirect()->route('dashboard')->with('success', 'Application status updated successfully.');
    }
}



