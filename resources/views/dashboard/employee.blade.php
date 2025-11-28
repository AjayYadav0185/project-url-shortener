<x-app-layout>
    <h1>Your Short URLs</h1>

    <form method="POST" action="{{ route('urls.store') }}">
        @csrf
        <input type="text" name="url" placeholder="Enter original URL">
        <button type="submit">Create</button>
    </form>

    <h3>Your URLs</h3>
    <ul>
        @foreach($myUrls as $url)
            <li>{{ $url->slug }} → {{ $url->original_url }}</li>
        @endforeach
    </ul>
</x-app-layout>
