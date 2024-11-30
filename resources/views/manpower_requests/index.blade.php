@extends('layouts.app')

@section('content')
    <h1>Manpower Requests</h1>

    @if($requests->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Department</th>
                    <th>Position</th>
                    <th>Urgency</th>
                    <th>Status</th>
                    <th>Requested By</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requests as $request)
                    <tr>
                        <td>{{ $request->id }}</td>
                        <td>{{ $request->department->name }}</td>
                        <td>{{ $request->position }}</td>
                        <td>{{ $request->urgency }}</td>
                        <td>{{ $request->status }}</td>
                        <td>{{ $request->requester->name }}</td>
                        <td>
                            <a href="{{ route('manpower_requests.show', $request) }}" class="btn btn-sm btn-info">View</a>
                            @can('update', $request)
                                <a href="{{ route('manpower_requests.edit', $request) }}" class="btn btn-sm btn-primary">Edit</a>
                            @endcan
                            @can('delete', $request)
                                <form action="{{ route('manpower_requests.destroy', $request) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            @endcan
                            @can('approve', $request)
                                @if($request->status === 'Pending')
                                    <form action="{{ route('manpower_requests.approve', $request) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                    </form>
                                    <form action="{{ route('manpower_requests.reject', $request) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        <input type="hidden" name="rejection_reason" value="Not needed at this time.">
                                        <button type="submit" class="btn btn-sm btn-warning" onclick="return confirm('Are you sure you want to reject this request?')">Reject</button>
                                    </form>
                                @endif
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $requests->links() }}
    @else
        <p>No manpower requests found.</p>
    @endif
@endsection
