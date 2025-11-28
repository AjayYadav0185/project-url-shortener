<h2>Short URLs</h2>

@if (session('success'))
  <p>{{ session('success') }}</p>
@endif

@if ($errors->any())
  <ul>
    @foreach($errors->all() as $e)
      <li>{{ $e }}</li>
    @endforeach
  </ul>
@endif

{{-- Form to create only if role allowed --}}
@auth
  @if (in_array(Auth::user()->role, ['sales','manager']))
    <form method="POST" action="{{ route('urls.store') }}">
      @csrf
      Original URL: <input type="url" name="original_url">
      <button>Create Short URL</button>
    </form>
  @endif
@endauth

<hr>

<ul>
@foreach ($urls as $u)
  <li>
    {{ $u->original_url }} <br>
    Short: {{ url('/r/' . $u->slug . '?token=' . $u->secret_token) }} <br>
    Created by UserID: {{ $u->user_id }}
  </li>
@endforeach
</ul>
