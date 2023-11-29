<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
    $rules = Game::validationRules("store");
    Validator::make($params, $rules)->validate();
    // Create a new game
    $new_game = new Game([
      "name" => $params["name"],
      "description" => $params["description"],
      "image" => ""
    ]);
    // Assign game's creator
    $new_game->user()->associate(Auth::user());
    $new_game->save();
    // Store the game boxart
    $extension = $params["image"]->getClientOriginalExtension();
    $location = "games/" . $new_game->id;
    $file_name = "boxart." . $extension;
    Storage::putFileAs($location, $params["image"], $file_name);
    $new_game->image = $location . "/" . $file_name;
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
    $rules = Game::validationRules("update");
    Validator::make($params, $rules)->validate();
    // Update game's data
    $game = Game::find($game_id);
    $game->name = $params["name"];
    $game->description =  $params["description"];
    if($params["image"]) {
      // Check if file already exists
      if(Storage::exists($game->image)) {
        Storage::delete($game->image);
      }
      // Store the new game boxart
      $extension = $params["image"]->getClientOriginalExtension();
      $location = "games/" . $game->id;
      $file_name = "boxart." . $extension;
      Storage::putFileAs($location, $params["image"], $file_name);
      $game->image = $location . "/" . $file_name;
    }
    $game->save();

    return redirect()->route('admin.games.show', [$game_id]);
  } // Update

  public function delete($game_id) {
    $game = Game::find($game_id);
    $game->delete();
    return redirect()->route('admin.games.index');
  } // Delete

}
