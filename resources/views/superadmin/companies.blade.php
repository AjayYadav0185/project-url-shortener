<!DOCTYPE html>
<html>
<head>
    <title>SuperAdmin - Companies</title>
</head>
<body>
<h2>Companies List</h2>

<ul>
@foreach($companies as $company)
    <li>{{ $company->name }} (ID: {{ $company->id }})</li>
@endforeach
</ul>

<h3>Invite User</h3>
<form method="POST" action="/superadmin/invite">
    @csrf
    <input type="text" name="name" placeholder="Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <select name="role" required>
        <option value="">Select Role</option>
        <option value="Sales">Sales</option>
        <option value="Manager">Manager</option>
        <option value="Member">Member</option>
    </select>
    <select name="company_id" required>
        <option value="">Select Company</option>
        @foreach($companies as $company)
            <option value="{{ $company->id }}">{{ $company->name }}</option>
        @endforeach
    </select>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Invite</button>
</form>
</body>
</html>
