@extends('layouts.app')

@section('content')
    <h1>Manpower Request Details</h1>

    <div class="card">
        <div class="card-header">
            Request #{{ $manpowerRequest->id }}
        </div>
        <div class="card-body">
            <p><strong>Department:</strong> {{ $manpowerRequest->department->name }}</p>
            <p><strong>Position:</strong> {{ $manpowerRequest->position }}</p>
            <p><strong>Skills Required:</strong> {{ $manpowerRequest->skills_required }}</p>
            <p><strong>Urgency:</strong> {{ $manpowerRequest->urgency }}</p>
            <p><strong>Status:</strong> {{ $manpowerRequest->status }}</p>
            <p><strong>Requested By:</strong> {{ $manpowerRequest->requester->name }}</p>
            @if($manpowerRequest->approved_by)
                <p><strong>Approved By:</strong> {{ $manpowerRequest->approver->name }}</p>
            @endif
            <p><strong>Created At:</strong> {{ $manpowerRequest->created_at->format('d M Y, H:i') }}</p>
            <p><strong>Updated At:</strong> {{ $manpowerRequest->updated_at->format('d M Y, H:i') }}</p>
        </div>
    </div>

    @can('update', $manpowerRequest)
        <a href="{{ route('manpower_requests.edit', $manpowerRequest) }}" class="btn btn-primary mt-3">Edit</a>
    @endcan

    @can('delete', $manpowerRequest)
        <form action="{{ route('manpower_requests.destroy', $manpowerRequest) }}" method="POST" style="display:inline-block;" class="mt-3">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this request?')">Delete</button>
        </form>
    @endcan
@endsection
