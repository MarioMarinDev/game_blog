<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GameController extends Controller {
  // CRUD (Create, Read, Update, Delete)
  public function index() {
    $games = Game::all();
    return view("admin.games.index")->with([
      "games" => $games
    ]);
  } // Read

  public function show(int $game_id) {
    $game = Game::find($game_id);
    return view("admin.games.show")->with([
      "game" => $game
    ]);
  } // Read

  public function create() {
    return view("admin.games.create");
  } // Create

  public function store(Request $request) {
    $params = $request->all();
    $rules = Game::validationRules();
    Validator::make($params, $rules)->validate();
    // Create a new game
    $new_game = new Game([
      "name" => $params["name"],
      "description" => $params["description"],
      "image" => $params["image"]
    ]);
    // Assign game's creator
    $new_game->user()->associate(Auth::user());
    $new_game->save();
    // Return the user to the games list
    return redirect()->route("admin.games.index");
  } // Create

  public function edit(int $game_id) {
    $game = Game::find($game_id);
    return view("admin.games.edit")->with([
      "game" => $game
    ]);
  } // Update

  public function update(int $game_id, Request $request) {
    $params = $request->all();
    $rules = Game::validationRules();
    Validator::make($params, $rules)->validate();
    // Update game's data
    $game = Game::find($game_id);
    $game->name = $params["name"];
    $game->description =  $params["description"];
    $game->image = $params["image"];
    $game->save();

    return redirect()->route('admin.games.show', [$game_id]);
  } // Update

  public function delete($game_id) {
    $game = Game::find($game_id);
    $game->delete();
    return redirect()->route('admin.games.index');
  } // Delete

}
