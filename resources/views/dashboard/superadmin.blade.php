<x-app-layout>
    <h1>SuperAdmin Dashboard</h1>

    <h3>Companies</h3>
    <ul>
        @forelse($companies as $company)
            <li>Company #{{ $company->id }}</li>
        @empty
            <p>No companies found.</p>
        @endforelse
    </ul>

    <h3>All Users</h3>
    <ul>
        @foreach($users as $user)
            <li>{{ $user->name }} ({{ $user->role }})</li>
        @endforeach
    </ul>

    <a href="{{ route('invitations.create') }}">Invite User</a>
</x-app-layout>
