
@extends("layouts.app")

@section("container")
  <div class="d-flex justify-content-between align-items-center">
    <h1>Juegos</h1>
    <a href="{{ route('admin.games.create') }}" class="btn btn-primary">Nuevo</a>
  </div>
  <hr>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Nombre</th>
        <th scope="col">Acciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($games as $game)
        <tr>
          <td>{{ $game->id }}</td>
          <td>
            <a href="{{ route('admin.games.show', [$game->id]) }}">{{ $game->name }}</a>
          </td>
          <td>
            <a href="{{ route('admin.games.edit', [$game->id]) }}" class="btn btn-secondary btn-sm">Editar</a>
            <form action="{{ route('admin.games.delete', [$game->id]) }}" method="POST" style="display: inline;">
              @csrf
              @method("DELETE")
              <button type="submit" class="btn btn-danger btn-sm">Borrar</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection
