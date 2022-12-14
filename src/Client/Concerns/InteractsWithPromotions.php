<?php

namespace ContestKit\Sdk\Client\Concerns;

use Illuminate\Validation\ValidationException;

trait InteractsWithPromotions
{
    public function promotion(string $promotion, array $with = [])
    {
        $request = $this->getClient()
            ->get("{$promotion}/promotion", ['with' => $with]);

        $this->handleRequest(request: $request);

        return $request->json('data');
    }

    public function promotionWinners(string|int $promotion)
    {
        $request = $this->getClient()
            ->get("promotion/{$promotion}/winners");

        $this->handleRequest(request: $request);

        return $request->json('data');
    }

    public function earlyAccess(string $promotion, array $data = [])
    {
        $request = $this->getClient()
            ->post("promotion/{$promotion}/early-access", $data);

        if ($request->clientError() && $request->status() === 422) {
            throw ValidationException::withMessages($request->json()['errors']);
        }

        $this->handleRequest(request: $request);

        return $request->json();
    }

    public function sendEarlyAccess(string $promotion, array $data)
    {
        $request = $this->getClient()
            ->post("promotion/{$promotion}/early-access/send", $data);

        $this->handleRequest(request: $request);

        return $request->json();
    }
}
