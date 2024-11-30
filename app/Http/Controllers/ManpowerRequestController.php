<?php

namespace App\Http\Controllers;

use App\Models\ManpowerRequest;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ManpowerRequestController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    // Display a listing of manpower requests
    public function index()
    {
        $user = Auth::user();

        // if ($user->hasRole('HR')) {
            $requests = ManpowerRequest::with('department', 'requester')->paginate(10);
        // } else {
        //     $requests = $user->manpowerRequests()->with('department')->paginate(10);
        // }

        return view('manpower_requests.index', compact('requests'));
    }

    // Show the form for creating a new manpower request
    public function create()
    {
        $departments = Department::all();
        return view('manpower_requests.create', compact('departments'));
    }

    // Store a newly created manpower request in storage
    public function store(Request $request)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'position' => 'required|string|max:255',
            'skills_required' => 'required|string',
            'urgency' => 'required|in:Low,Medium,High',
        ]);

        ManpowerRequest::create([
            'department_id' => $request->department_id,
            'position' => $request->position,
            'skills_required' => $request->skills_required,
            'urgency' => $request->urgency,
            'requested_by' => Auth::id(),
            'status' => 'Pending',
        ]);

        // Optionally, notify HR about the new request
        // Notification::send($hrUsers, new NewManpowerRequestNotification($request));

        return redirect()->route('manpower_requests.index')->with('success', 'Manpower request submitted successfully.');
    }

    // Display the specified manpower request
    public function show(ManpowerRequest $manpowerRequest)
    {
        $this->authorize('view', $manpowerRequest);
        return view('manpower_requests.show', compact('manpowerRequest'));
    }

    // Show the form for editing the specified manpower request
    public function edit(ManpowerRequest $manpowerRequest)
    {
        $this->authorize('update', $manpowerRequest);
        $departments = Department::all();
        return view('manpower_requests.edit', compact('manpowerRequest', 'departments'));
    }

    // Update the specified manpower request in storage
    public function update(Request $request, ManpowerRequest $manpowerRequest)
    {
        $this->authorize('update', $manpowerRequest);

        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'position' => 'required|string|max:255',
            'skills_required' => 'required|string',
            'urgency' => 'required|in:Low,Medium,High',
        ]);

        $manpowerRequest->update($request->only(['department_id', 'position', 'skills_required', 'urgency']));

        return redirect()->route('manpower_requests.index')->with('success', 'Manpower request updated successfully.');
    }

    // Remove the specified manpower request from storage
    public function destroy(ManpowerRequest $manpowerRequest)
    {
        $this->authorize('delete', $manpowerRequest);
        $manpowerRequest->delete();

        return redirect()->route('manpower_requests.index')->with('success', 'Manpower request deleted successfully.');
    }

    // Additional methods for approval/rejection
    public function approve(ManpowerRequest $manpowerRequest)
    {
        $this->authorize('approve', $manpowerRequest);

        $manpowerRequest->update([
            'status' => 'Approved',
            'approved_by' => Auth::id(),
        ]);

        // Optionally, notify the requester
        // Notification::send($manpowerRequest->requester, new ManpowerRequestApprovedNotification($manpowerRequest));

        return redirect()->route('manpower_requests.index')->with('success', 'Manpower request approved.');
    }

    public function reject(Request $request, ManpowerRequest $manpowerRequest)
    {
        $this->authorize('approve', $manpowerRequest);

        $request->validate([
            'rejection_reason' => 'required|string',
        ]);

        $manpowerRequest->update([
            'status' => 'Rejected',
            'approved_by' => Auth::id(),
        ]);

        // Optionally, store rejection reason or notify the requester
        // $manpowerRequest->update(['rejection_reason' => $request->rejection_reason]);

        return redirect()->route('manpower_requests.index')->with('success', 'Manpower request rejected.');
    }
}
