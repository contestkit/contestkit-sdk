<?php

namespace ContestKit\Sdk\Data\DTO;

use Spatie\LaravelData\Data;

class Referral extends Data
{
    public function __construct(
        public readonly string $referred_message,
        public readonly string $referral_title,
        public readonly string $referral_message,
        public readonly string $referral_url
    ) {
    }
}
