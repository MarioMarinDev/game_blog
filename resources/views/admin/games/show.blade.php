@extends("layouts.app")

@section("container")
  <h1>{{ $game->name }}</h1>
  <div>
    <img src="{{ $game->getImageUrl() }}" alt="Box Art" width="200" height="300">
  </div>
  <p>{{ $game->description }}</p>
  <hr>
  <div>
    <a href="{{ route('admin.games.index') }}" class="btn btn-primary">Regresar</a>
  </div>
@endsection
