<?php

namespace ContestKit\Sdk\Client\Concerns;

trait InteractsWithPromotions
{
    public function promotion(string $promotion)
    {
        $request = $this->getClient()
            ->get("{$promotion}/promotion");
        dd($request->json());
        $this->handleRequest(request: $request);

        return $request->json('data');
    }
}
