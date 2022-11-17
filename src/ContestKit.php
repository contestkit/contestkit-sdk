<?php

namespace ContestKit\Sdk;

use ContestKit\Sdk\Client\ContestKitClient;
use Illuminate\Support\Facades\Facade;

class ContestKit extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ContestKitClient::class;
    }
}
