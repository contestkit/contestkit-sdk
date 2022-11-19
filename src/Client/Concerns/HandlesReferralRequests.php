<?php

namespace ContestKit\Sdk\Client\Concerns;

trait HandlesReferralRequests
{
    public function referral(string $campaign, string $referral)
    {
        $request = $this->getClient()->get("{$campaign}/referral", [
            'referral' => $referral,
        ]);

        $this->handleRequest(request: $request);

        return $request->json('data');
    }
}
