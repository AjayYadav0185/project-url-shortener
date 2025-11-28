<x-app-layout>
    <h1>Admin Dashboard</h1>

    <h3>Your Company Users</h3>
    <ul>
        @foreach($companyUsers as $u)
            <li>{{ $u->name }} - {{ $u->role }}</li>
        @endforeach
    </ul>

    <h3>External URLs</h3>
    <ul>
        @foreach($externalUrls as $url)
            <li>{{ $url->slug }} → {{ $url->original_url }}</li>
        @endforeach
    </ul>

    <a href="{{ route('invitations.create') }}">Invite Member</a>
</x-app-layout>
