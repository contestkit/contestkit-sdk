<?php

namespace ContestKit\Sdk\Data\Game;

use Illuminate\Database\Eloquent\Model;

class GameResult extends Model
{
    protected $fillable = [
        'external_id',
        'credits',
        'last_played_at',
        'name',
        'email',
        'bare_email',
        'verified',
        'email_verified_at',
        'registered_at',
        'wasRecentlyCreated',
    ];

    protected $casts = [
        'wasRecentlyCreated' => 'boolean',
        'verified' => 'boolean',
        'email_verified_at' => 'datetime',
        'registered_at' => 'datetime',
        'last_played_at' => 'datetime',
    ];

    public function newCollection(array $models = [])
    {
        return new GameResultCollection($models);
    }
}
