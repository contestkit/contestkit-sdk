<?php

namespace ContestKit\Sdk\Client\Concerns;
use Illuminate\Validation\ValidationException;

trait HandlesShippingInformationRequests
{
    public function getShipping(int $winnerSid)
    {
        $request = $this->getClient()
            ->get("/winners/{$winnerSid}/shipping-address");

        $this->handleRequest(request: $request);

        return $request->json();
    }

    public function storeShipping(int $winnerSid, array $params)
    {
        $request = $this->getClient()
            ->post("/winners/{$winnerSid}/shipping-address", $params);


        if ($request->clientError()) {
            throw ValidationException::withMessages($request->json('errors'));
        }

        $this->handleRequest(request: $request);

        return $request->json();
    }

    public function deleteShipping(int $winnerSid)
    {
        $request = $this->getClient()
            ->delete("/winners/{$winnerSid}/shipping-address");

        $this->handleRequest(request: $request);

        return $request->json();
    }
}