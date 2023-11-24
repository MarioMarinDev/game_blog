<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::namespace("Admin")->prefix('admin')->middleware(["auth", "isUserAdmin"])->group(function() {
  Route::prefix('games')->group(function() {
    Route::get("/", [App\Http\Controllers\Admin\GameController::class, "index"])->name("admin.games.index");
    Route::get("/create", [App\Http\Controllers\Admin\GameController::class, "create"])->name("admin.games.create");
    Route::post("/", [App\Http\Controllers\Admin\GameController::class, "store"])->name("admin.games.store");
    Route::prefix("{game_id}")->middleware("isGame")->group(function() {
      Route::get("/", [App\Http\Controllers\Admin\GameController::class, "show"])->name("admin.games.show");
      Route::get("edit", [App\Http\Controllers\Admin\GameController::class, "edit"])->name("admin.games.edit");
      Route::post("update", [App\Http\Controllers\Admin\GameController::class, "update"])->name("admin.games.update");
      Route::delete("/", [App\Http\Controllers\Admin\GameController::class, "delete"])->name("admin.games.delete");
    });
  });
});
