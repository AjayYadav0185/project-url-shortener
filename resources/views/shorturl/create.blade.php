<!DOCTYPE html>
<html>
<head><title>Create Short URL</title></head>
<body>
<h2>Create Short URL</h2>

@if(session('success'))
<p style="color:green">{{ session('success') }}</p>
@endif

<form method="POST" action="/short-url">
    @csrf
    <input type="url" name="original_url" placeholder="Enter URL" required>
    <button type="submit">Create Short URL</button>
</form>
</body>
</html>
