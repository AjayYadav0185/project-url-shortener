<!DOCTYPE html>
<html>
<head>
    <title>Admin - Short URLs</title>
</head>
<body>
<h2>Short URLs (Not from your company)</h2>

<ul>
@foreach($urls as $url)
    <li>
        Original: {{ $url->original_url }} |
        Short: <a href="/r/{{ $url->short_code }}">{{ $url->short_code }}</a> |
        Created by User ID: {{ $url->user_id }} |
        Company ID: {{ $url->company_id }}
    </li>
@endforeach
</ul>

<h3>Invite User</h3>
<form method="POST" action="/admin/invite">
    @csrf
    <input type="text" name="name" placeholder="Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <select name="role" required>
        <option value="">Select Role</option>
        <option value="Sales">Sales</option>
        <option value="Manager">Manager</option>
    </select>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Invite</button>
</form>
</body>
</html>
