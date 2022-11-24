<?php

namespace ContestKit\Sdk\Client\Concerns;

trait InteractsWithCampaigns
{
    public function campaign(string $campaign)
    {
        $request = $this->getClient()
            ->get("{$campaign}/campaign");

        $this->handleRequest(request: $request);

        return $request->json('data');
    }

    public function campaigns()
    {
        $request = $this->getClient()
            ->get('campaigns');

        $this->handleRequest(request: $request);

        return $request->json('data');
    }
}
