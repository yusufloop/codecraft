<table>
    <thead>
        <tr>
            <th>Applicant</th>
            <th>Position</th>
            <th>Experience</th>
            <th>Skills</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($applications as $application)
            <tr>
                <td>{{ $application->applicant->name }}</td>
                <td>{{ $application->job->position }}</td>
                <td>{{ $application->applicant->experience }}</td>
                <td>{{ implode(', ', json_decode($application->skills)) }}</td>
                <td>{{ $application->status }}</td>
                <td>
                    <form method="POST" action="{{ route('applications.update', $application->id) }}">
                        @csrf
                        @method('PATCH')
                        <select name="status">
                            <option value="Pending" {{ $application->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Shortlisted" {{ $application->status === 'Shortlisted' ? 'selected' : '' }}>Shortlisted</option>
                            <option value="Rejected" {{ $application->status === 'Rejected' ? 'selected' : '' }}>Rejected</option>
                            <option value="Hired" {{ $application->status === 'Hired' ? 'selected' : '' }}>Hired</option>
                        </select>
                        <button type="submit">Update Status</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
