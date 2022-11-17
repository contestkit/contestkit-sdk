<?php

namespace ContestKit\Sdk\Data\Registration;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'external_id',
        'credits',
        'credits_daily_allotment',
        'referral',
        'last_played_at',
        'play_again_at',
        'name',
        'email',
        'bare_email',
        'verified',
        'email_verified_at',
        'registered_at',
        'wasRecentlyCreated',
        'winner',
    ];

    protected $casts = [
        'referral' => 'array',
        'winner' => 'array',
        'wasRecentlyCreated' => 'boolean',
        'verified' => 'boolean',
        'email_verified_at' => 'datetime',
        'registered_at' => 'datetime',
        'last_played_at' => 'datetime',
        'play_again_at' => 'datetime',
    ];

    public function newCollection(array $models = [])
    {
        return new RegistrationCollection($models);
    }
}
