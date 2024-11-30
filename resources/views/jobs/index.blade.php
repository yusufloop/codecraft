<!-- resources/views/jobs/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Job Advertisements</h1>

        @foreach ($jobs as $job)
            <div class="job-listing">
                <h3>{{ $job->title }}</h3>
                <p>{{ $job->description }}</p>
                <p><strong>Location:</strong> {{ $job->location }}</p>
                <p><strong>Type:</strong> {{ ucfirst($job->job_type) }}</p>
                <p><strong>Salary:</strong> ${{ number_format($job->salary, 2) }}</p>
            </div>
        @endforeach
    </div>
@endsection
