<?php

namespace ContestKit\Sdk\Client\Concerns;

trait HandlesScratchCardRequests
{
    public function pull(string $campaign, string $registration)
    {
        $request = $this->getClient()->post("{$campaign}/scratch", [
            'registration' => $registration,
        ]);

        $this->handleRequest(request: $request);

        return $request->json('data');
    }

    public function verify(string $campaign, string $registration, string $game)
    {
        $request = $this->getClient()->patch("{$campaign}/scratch", [
            'registration' => $registration,
            'game' => $game,
        ]);

        $this->handleRequest(request: $request);

        return $request->json('data');
    }
}
