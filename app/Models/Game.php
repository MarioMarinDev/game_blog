<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Game extends Model {
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['name', 'image', 'user_id', 'description'];

  /* =================================================================
    [ VALIDATION ]
  ================================================================= */
  public static function validationRules($scenario): array {
    switch($scenario) {
      case "store":
        return [
          "name" => "required|string|min:1|max:255",
          "description" => "string|min:5|max:500",
          "image" => "required|image|max:2048"
        ];
        break;
      case "update":
        return [
          "name" => "required|string|min:1|max:255",
          "description" => "string|min:5|max:500",
          "image" => "nullable|image|max:2048"
        ];
        break;
    }
  }

  /* =================================================================
    [ PUBLIC FUNCTION ]
  ================================================================= */
  /**
   * Get the game's current image URL
   * @return string
   */
  public function getImageUrl(): string {
    if(str_contains($this->image, "http")) {
      return $this->image;
    } else if(Storage::missing($this->image)) {
      return "";
    }
    return Storage::url($this->image);
  }

  /* =================================================================
    [ RELATIONSHIPS ]
  ================================================================= */
  /**
   * Get the user that created this game.
   */
  public function user(): BelongsTo {
    return $this->belongsTo(User::class);
  }

}
