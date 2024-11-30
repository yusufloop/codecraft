<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Listings</title>
</head>
<body>
    <h1>Job Listings</h1>

    <form action="{{ route('jobs.index') }}" method="GET">
        <!-- Search by Dropdown -->
        <label for="search_field">Search by:</label>
        <select name="search_field" id="search_field">
            <option value="title" {{ request('search_field') === 'title' ? 'selected' : '' }}>Title</option>
            <option value="location" {{ request('search_field') === 'location' ? 'selected' : '' }}>Location</option>
            <option value="department" {{ request('search_field') === 'department' ? 'selected' : '' }}>Department</option>
        </select>
    
        <!-- Search Term Input -->
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Enter search term">

    
        <button type="submit">Search</button>
    </form>
    
 <!-- Table for Job Listings -->
    <table border="1">
        <thead>
            <tr>
                <th>Title</th>
                <th>Location</th>
                <th>Department</th>
                <th>Description</th>
                <th>Action</th> <!-- New Column for Apply Button -->
            </tr>
        </thead>
        <tbody>
            @forelse ($jobs as $job)
                <tr>
                    <td>{{ $job->title }}</td>
                    <td>{{ $job->location }}</td>
                    <td>{{ $job->department }}</td>
                    <td>{{ $job->description }}</td>
                    <td>
                        <!-- Apply Button linking to the apply form for each job -->
                        <a href="{{ route('jobs.apply', $job->id) }}">
                            <button type="button">Apply for Job</button>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No jobs found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Success Message -->
    @if(session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

</body>
</html>