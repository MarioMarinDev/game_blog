@extends("layouts.app")

@section("container")
<h1>Editar - {{ $game->name }}</h1>
<hr>
<form action="{{ route('admin.games.update', [$game->id]) }}" method="POST">
  @csrf
  <div class="form-group">
    <label for="name">Nombre:</label>
    <input type="text" name="name" id="name" class="form-control" value="{{ $game->name }}" required>
    @error('name')
      <span class="text-danger">{{ $message }}</span>
    @enderror
  </div>
  <div class="form-group mt-3">
    <label for="description">Descripción:</label>
    <textarea name="description" id="description" rows="3" class="form-control">{{ $game->description }}</textarea>
    @error('description')
      <span class="text-danger">{{ $message }}</span>
    @enderror
  </div>
  <div class="form-group mt-3">
    <label for="image">URL de la imagen</label>
    <input type="text" name="image" id="image" class="form-control" value="{{ $game->image }}" required>
    @error('image')
      <span class="text-danger">{{ $message }}</span>
    @enderror
  </div>
  <hr>
  <div class="text-end">
    <a href="{{ route('admin.games.index') }}" class="btn btn-secondary">Cancelar</a>
    <button type="submit" class="btn btn-success">Enviar</button>
  </div>
</form>
@endsection
