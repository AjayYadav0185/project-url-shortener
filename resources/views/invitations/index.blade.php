<h2>Pending Invitations</h2>

<a href="{{ route('invitations.create') }}">Invite User</a>

<ul>
@foreach($invitations as $inv)
    <li>{{ $inv->email }} — Role: {{ $inv->role }}</li>
@endforeach
</ul>
