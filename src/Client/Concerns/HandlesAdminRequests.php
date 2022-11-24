<?php

namespace ContestKit\Sdk\Client\Concerns;

trait HandlesAdminRequests
{
    public function accountPromotions()
    {
        $request = $this->getClient()
            ->get("account/promotions");

        $this->handleRequest(request: $request);

        return $request->json('data');
    }

    public function accountPromotion(int $promotionId)
    {
        $request = $this->getClient()
            ->get("account/{$promotionId}/promotion");

        $this->handleRequest(request: $request);

        return $request->json('data');
    }
    public function accountPromotionCampaigns(int $promotionId)
    {
        $request = $this->getClient()
            ->get("account/{$promotionId}/promotion");

        $this->handleRequest(request: $request);

        return $request->json('data');
    }

    public function accountCampaigns()
    {
        $request = $this->getClient()
            ->get("account/campaigns");

        $this->handleRequest(request: $request);

        return $request->json('data');
    }

    public function accountCampaign(int $campaignId)
    {
        $request = $this->getClient()
            ->get("account/{$campaignId}/campaign");

        $this->handleRequest(request: $request);

        return $request->json('data');
    }
}