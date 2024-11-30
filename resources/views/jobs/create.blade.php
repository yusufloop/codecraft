<!-- resources/views/jobs/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create a Job Advertisement</h1>

        <form action="{{ route('jobs.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Job Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Job Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" id="location" name="location" value="{{ old('location') }}" required>
            </div>

            <div class="mb-3">
                <label for="job_type" class="form-label">Job Type</label>
                <select class="form-control" id="job_type" name="job_type" required>
                    <option value="full_time" {{ old('job_type') == 'full_time' ? 'selected' : '' }}>Full-Time</option>
                    <option value="part_time" {{ old('job_type') == 'part_time' ? 'selected' : '' }}>Part-Time</option>
                    <option value="contract" {{ old('job_type') == 'contract' ? 'selected' : '' }}>Contract</option>
                    <option value="internship" {{ old('job_type') == 'internship' ? 'selected' : '' }}>Internship</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="salary" class="form-label">Salary</label>
                <input type="number" class="form-control" id="salary" name="salary" value="{{ old('salary') }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Create Job</button>
        </form>
    </div>
@endsection
