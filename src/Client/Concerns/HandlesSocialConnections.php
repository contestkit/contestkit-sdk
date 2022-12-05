<?php

namespace ContestKit\Sdk\Client\Concerns;

trait HandlesSocialConnections
{
    public function connectTwitterProfile(string $campaign, int $registration, array $data = [])
    {
        $request = $this->getClient()->post("{$campaign}/me/{$registration}/profile/twitter", $data);

        $this->handleRequest(request: $request);
        return $request->json('data');
    }
}