<?php

namespace ContestKit\Sdk\Client\Concerns;

trait HandlesDrawRequests
{
    public function draw(string $campaign, string $draw, string $registration)
    {
        $request = $this->getClient()
            ->get("{$campaign}/draws/{$draw}", [
                'registration' => $registration,
            ]);

        $this->handleRequest(request: $request);

        return $request->json('data');
    }

    public function draws(string $campaign, string $registration)
    {
        $request = $this->getClient()
            ->get("{$campaign}/draws", [
                'registration' => $registration,
            ]);

        return $request->json('data');
    }
    
    public function autoSelectNumbersForDraw(string $campaign, string $draw, string $registration)
    {
        $request = $this->getClient()
            ->post("{$campaign}/draws/{$draw}/quick-pick", [
                'registration' => $registration,
            ]);

        return $this->handleRequest(request: $request);
    }

    public function selectNumbersForDraw(string $campaign, string $draw, string $registration, array $numbers)
    {
        $request = $this->getClient()
            ->post("{$campaign}/draws/{$draw}", [
                'registration' => $registration,
                'numbers' => $numbers,
            ]);

        return $this->handleRequest(request: $request);
    }

    public function publicDraws(string $campaign)
    {
        $request = $this->getClient()->get("{$campaign}/draw");

        return $request->json('data');
    }

    public function publicDraw(string $campaign, string $draw)
    {
        $request = $this->getClient()->get("{$campaign}/draw/{$draw}");

        return $request->json('data');
    }
}