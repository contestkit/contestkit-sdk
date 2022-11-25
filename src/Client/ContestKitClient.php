<?php

namespace ContestKit\Sdk\Client;

use ContestKit\Sdk\Client\Concerns\HandlesAdminRequests;
use ContestKit\Sdk\Client\Concerns\HandlesDrawRequests;
use ContestKit\Sdk\Client\Concerns\HandlesReferralRequests;
use ContestKit\Sdk\Client\Concerns\HandlesRegistrations;
use ContestKit\Sdk\Client\Concerns\HandlesRequests;
use ContestKit\Sdk\Client\Concerns\HandlesScratchCardRequests;
use ContestKit\Sdk\Client\Concerns\InteractsWithCampaigns;
use ContestKit\Sdk\Client\Concerns\InteractsWithPromotions;
use Illuminate\Support\Facades\Http;

class ContestKitClient
{
    use HandlesRequests;
    use HandlesAdminRequests;
    use InteractsWithCampaigns;
    use InteractsWithPromotions;
    use HandlesRegistrations;
    use HandlesScratchCardRequests;
    use HandlesDrawRequests;
    use HandlesReferralRequests;

    public function __construct(protected array $config)
    {
    }

    protected function getClient()
    {
        return Http::withHeaders(
            array_merge(data_get($this->config, 'headers'), [
                'X-ContestKit-Host' => request()->getHttpHost(),
            ])
        )->withToken(data_get($this->config, 'access_token'))
            ->baseUrl(data_get($this->config, 'base_url'));
    }

    public function winners(string $campaign)
    {
        $request = $this->getClient()
            ->get("{$campaign}/winners");

        $this->handleRequest(request: $request);

        return $request->json('data');
    }

    public function prizes(string $campaign)
    {
        $request = $this->getClient()
            ->get("{$campaign}/prizes");

        $this->handleRequest(request: $request);

        return $request->json('data');
    }
}
