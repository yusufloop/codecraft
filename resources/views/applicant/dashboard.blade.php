<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applicant Dashboard</title>
</head>
<body>
    <h1>Your Job Applications</h1>

    @if (isset($message))
        <p>{{ $message }}</p>
    @endif

    @if ($applications->isEmpty())
        <p>No applications found. <a href="{{ route('jobs.index') }}">Browse Job Listings</a></p>
    @else
        <table border="1">
            <thead>
                <tr>
                    <th>Job Title</th>
                    <th>Status</th>
                    <th>Applied On</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($applications as $application)
                    <tr>
                        <td>{{ $application->job->title }}</td>
                        <td>{{ ucfirst($application->status) }}</td>
                        <td>{{ $application->created_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('jobs.index') }}">Back to Job Listings</a>
</body>
</html>

