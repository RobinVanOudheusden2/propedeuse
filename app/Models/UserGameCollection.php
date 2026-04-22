<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class UserGameCollection extends Model
{
    protected $table = 'user_game_collections';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'game_id',
        'status',
        'rating',
        'notes',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }
}
