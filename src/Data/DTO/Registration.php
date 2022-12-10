<?php

namespace ContestKit\Sdk\Data\DTO;

use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;

class Registration extends Data
{
    public string $external_id;
    public int $credits;
    public int $credits_daily_allotment;

    public string $name;
    public string $email;
    public string $bare_email;
    public string $hash_id;
    public bool $verified;

    public array|null $winner;

    public Referral $referral;

    #[WithCast(DateTimeInterfaceCast::class)]
    public string $registered_at;
    #[WithCast(DateTimeInterfaceCast::class)]
    public string | null $last_played_at;
    #[WithCast(DateTimeInterfaceCast::class)]
    public string | null $email_verified_at;
    #[WithCast(DateTimeInterfaceCast::class)]
    public string $play_again_at;

    public function __construct(array $data)
    {
        $this->external_id = data_get($data, 'id');
        $this->name = data_get($data, 'first_name').' '.data_get($data, 'last_name');
        $this->email = data_get($data, 'email_address');
        $this->bare_email = data_get($data, 'bare_email');
        $this->registered_at = data_get($data, 'created_at');
        $this->hash_id = data_get($data, 'hash_id');
        $this->verified = data_get($data, 'verified');
        $this->email_verified_at = data_get($data, 'verified_at');
        $this->credits = data_get($data, 'credits.count');
        $this->credits_daily_allotment = data_get($data, 'credits.daily_allotment');
        $this->last_played_at = data_get($data, 'credits.last_played_at');
        $this->play_again_at = data_get($data, 'credits.play_again_at');
        $this->referral = new Referral(...data_get($data, 'referral'));
        $this->winner = data_get($data, 'winner');
    }
}
