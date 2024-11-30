<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ route('manpower_requests.index') }}">Maybank Recruitment</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('manpower_requests.index') }}">Manpower Requests</a>
                </li>
                @role('Department Head')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('manpower_requests.create') }}">Submit Request</a>
                    </li>
                @endrole
            @endauth
        </ul>
        <ul class="navbar-nav ml-auto">
            @auth
                <li class="nav-item">
                    <span class="nav-link">Hello, {{ Auth::user()->name }}</span>
                </li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-link nav-link" type="submit">Logout</button>
                    </form>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
            @endauth
        </ul>
    </div>
</nav>
