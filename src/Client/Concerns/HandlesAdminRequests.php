<?php

namespace ContestKit\Sdk\Client\Concerns;

trait HandlesAdminRequests
{
    public function accountPromotions()
    {
        $request = $this->getClient()
            ->get("admin/promotions");
        dd($request->json());
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
            ->get("admin/campaigns");

        $this->handleRequest(request: $request);

        return $request->json('data');
    }

    public function accountCampaign(int $campaignId)
    {
        $request = $this->getClient()
            ->get("admin/{$campaignId}/campaign");

        $this->handleRequest(request: $request);

        return $request->json('data');
    }
}
