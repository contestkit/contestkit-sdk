<?php

namespace ContestKit\Sdk\Client\Concerns;

trait HandlesAdminRequests
{
    public function accountPromotions()
    {
        $request = $this->getClient()
            ->get('admin/promotions');

        $this->handleRequest(request: $request);

        return $request->json('data');
    }

    public function accountPromotion(int $promotionId)
    {
        $request = $this->getClient()
            ->get("admin/{$promotionId}/promotion");

        $this->handleRequest(request: $request);

        return $request->json('data');
    }

    public function accountPromotionCampaigns(int $promotionId)
    {
        $request = $this->getClient()
            ->get("admin/{$promotionId}/promotion/campaigns");

        $this->handleRequest(request: $request);

        return $request->json('data');
    }

    public function accountCampaigns()
    {
        $request = $this->getClient()
            ->get('admin/campaigns');

        $this->handleRequest(request: $request);

        return $request->json('data');
    }

    public function accountCampaign(int $campaignId, array $with = [])
    {
        $request = $this->getClient()
            ->get("admin/{$campaignId}/campaign", ['with' => $with]);

        $this->handleRequest(request: $request);

        return $request->json('data');
    }
}
