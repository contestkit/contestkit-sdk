<?php

namespace ContestKit\Sdk\Client\Concerns;

trait InteractsWithPrizes
{

    public function getPrize(string $prizeId)
    {
        $request = $this->getClient()
            ->get("prizes/{$prizeId}");

        $this->handleRequest(request: $request);

        return $request->json('data');
    }

    public function promotionPrizes(string $promotion, bool $featured = false)
    {
        $request = $this->getClient()
            ->get("{$promotion}/promotion/prizes", ['featured' => $featured]);

        $this->handleRequest(request: $request);

        return $request->json('data');
    }

    // TODO
    public function campaiginPrizes(string $campaIGN, bool $featured = false)
    {
        $request = $this->getClient()
            ->get("{$promotion}/promotion/prizes", ['featured' => $featured]);

        $this->handleRequest(request: $request);

        return $request->json('data');
    }

}