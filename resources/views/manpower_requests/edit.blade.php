@extends('layouts.app')

@section('content')
    <h1>Edit Manpower Request</h1>

    <form action="{{ route('manpower_requests.update', $manpowerRequest) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="department_id">Department</label>
            <select name="department_id" id="department_id" class="form-control" required>
                <option value="">-- Select Department --</option>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}" {{ (old('department_id', $manpowerRequest->department_id) == $department->id) ? 'selected' : '' }}>
                        {{ $department->name }}
                    </option>
                @endforeach
            </select>
            @error('department_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="position">Position</label>
            <input type="text" name="position" id="position" class="form-control" value="{{ old('position', $manpowerRequest->position) }}" required>
            @error('position')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="skills_required">Skills Required</label>
            <textarea name="skills_required" id="skills_required" class="form-control" rows="4" required>{{ old('skills_required', $manpowerRequest->skills_required) }}</textarea>
            @error('skills_required')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="urgency">Urgency</label>
            <select name="urgency" id="urgency" class="form-control" required>
                <option value="Low" {{ (old('urgency', $manpowerRequest->urgency) == 'Low') ? 'selected' : '' }}>Low</option>
                <option value="Medium" {{ (old('urgency', $manpowerRequest->urgency) == 'Medium') ? 'selected' : '' }}>Medium</option>
                <option value="High" {{ (old('urgency', $manpowerRequest->urgency) == 'High') ? 'selected' : '' }}>High</option>
            </select>
            @error('urgency')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Request</button>
    </form>
@endsection
