<?php

namespace ContestKit\Sdk\Client\Concerns;

use Illuminate\Validation\ValidationException;

trait HandlesRequests
{
    /**
     * @throws ValidationException
     */
    public function handleRequest($request)
    {
        if ($request->clientError()) {
            throw ValidationException::withMessages(['There was an issue with this request']);
        }

        if ($request->serverError()) {
            throw  ValidationException::withMessages([
                'service' => 'Service unavailable',
            ]);
        }

        return $request->json('data');
    }

}