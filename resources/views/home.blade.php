@extends('layouts.app')

@section('container')
<h1 class="mb-5 text-center">¡Bienvenido a mi página web {{ env("APP_NAME") }}!</h1>

<div class="row">
  @foreach ($games as $game)
    <div class="col-lg-3 col-md-6 col-12 text-center">
      <div class="game-box" style="background-image: url('{{ $game->image }}');"></div>
    </div>
  @endforeach
</div>

@endsection
