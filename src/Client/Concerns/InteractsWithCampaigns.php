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

    public function campaignPrizes(string $campaign, bool $featured = false)
    {
        $request = $this->getClient()
            ->get("{$campaign}/campaign/prizes", ['featured' => $featured ]);

        $this->handleRequest(request: $request);

        return $request->json('data');
    }
}
