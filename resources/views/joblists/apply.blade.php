<!-- resources/views/jobs/apply.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for Job - {{ $job->title }}</title>
</head>
<body>
    <h1>Apply for Job: {{ $job->title }}</h1>

    <form method="POST" action="{{ route('jobs.apply.submit', $job->id) }}" enctype="multipart/form-data">
        @csrf

        <!-- Input fields for the application -->
        <div>
            <label for="name">Full Name:</label>
            <input type="text" name="name" id="name" required>
        </div>

        <div>
            <label for="age">Age:</label>
            <input type="text" name="age" id="age" required>
        </div>

        <div>
            <label for="phone_no">Phone Number:</label>
            <input type="text" name="phone_no" id="phone_no" required>
        </div>

        <div>
            <label for="address">Address:</label>
            <input type="text" name="address" id="address" required>
        </div>

        <div>
            <label for="email">Email Address:</label>
            <input type="email" name="email" id="email" required>
        </div>

        <div>
            <label for="resume">Upload Resume:</label>
            <input type="file" name="resume" id="resume" accept=".pdf, .doc, .docx" required>
        </div>

        <button type="submit">Submit Application</button>
    </form>

    <a href="{{ route('jobs.index') }}">Back to Job Listings</a>
</body>
</html>
