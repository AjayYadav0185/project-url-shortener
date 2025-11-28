<x-app-layout>
    <h1>Invite User</h1>

    <form method="POST" action="{{ route('invitations.store') }}">
        @csrf
        <label>Email</label>
        <input type="email" name="email">

        <label>Role</label>
        <select name="role">
            <option value="Sales">Sales</option>
            <option value="Manager">Manager</option>
            <option value="Member">Member</option>
            <option value="Admin">Admin</option>
        </select>

        <label>Company</label>
        <input type="number" name="company_id">

        <button type="submit">Send Invite</button>
    </form>

</x-app-layout>
