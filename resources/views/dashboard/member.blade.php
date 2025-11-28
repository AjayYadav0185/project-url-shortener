<x-app-layout>
    <h1>Member Dashboard</h1>

    <h3>URLs Created by Others</h3>
    <ul>
        @foreach($urls as $url)
            <li>{{ $url->slug }} → {{ $url->original_url }}</li>
        @endforeach
    </ul>
</x-app-layout>
