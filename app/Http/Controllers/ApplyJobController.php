<?php

namespace App\Http\Controllers;

use App\Models\ApplyJob;
use Illuminate\Http\Request;

class ApplyJobController extends Controller
{
     // Display form for creating a job advertisement
     public function create()
     {
         return view('jobs.create');
     }
 
     // Store the job advertisement in the database
     public function store(Request $request)
     {
         $request->validate([
             'title' => 'required|string|max:255',
             'description' => 'required|string',
             'location' => 'required|string|max:255',
             'job_type' => 'required|in:full_time,part_time,contract,internship',
             'salary' => 'required|numeric|min:0',
         ]);
 
         ApplyJob::create($request->all());
 
         return redirect()->route('jobs.index')->with('success', 'Job advertisement created successfully!');
     }
 
     // Display all job advertisements
     public function index()
     {
         $jobs = ApplyJob::all();
         return view('jobs.index', compact('jobs'));
     }
}
