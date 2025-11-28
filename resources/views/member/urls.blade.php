<!DOCTYPE html>
<html>
<head>
    <title>Member - Short URLs</title>
</head>
<body>
<h2>Short URLs (Not created by you)</h2>

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
</body>
</html>
