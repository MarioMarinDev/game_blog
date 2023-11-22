<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Game extends Model {
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['name', 'image', 'user_id'];

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
