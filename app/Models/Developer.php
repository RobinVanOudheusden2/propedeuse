<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    protected $fillable = [
        'name',
        'country',
        'founded_year',
    ];

    public function games(): HasMany
    {
        return $this->hasMany(Game::class);
    }
}
