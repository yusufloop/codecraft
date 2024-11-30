<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobApplication;

class ApplicantDashboardController extends Controller
{
    public function index()
    {
        // Fetch all applications of the currently authenticated user
        $userId = auth()->id(); // This will be null for unauthenticated users

        if ($userId) {
            // If user is authenticated, fetch their applications
            $applications = JobApplication::where('user_id', $userId)->get();
        } else {
            // If no user is authenticated, initialize an empty collection
            $applications = collect();
        }

        // Check if applications are empty
        $message = $applications->isEmpty() ? 'You have not applied for any jobs yet.' : null;

        // Pass the data to the view
        return view('applicant.dashboard', compact('applications', 'message'));
    }
}

