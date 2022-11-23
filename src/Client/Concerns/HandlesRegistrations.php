<?php

namespace ContestKit\Sdk\Client\Concerns;

use ContestKit\Sdk\Data\DTO\Registration;
use Illuminate\Validation\ValidationException;

trait HandlesRegistrations
{
    public function me(string $campaign, string $registration): Registration|ValidationException
    {
        $request = $this->getClient()->get("{$campaign}/me/{$registration}");

        return $this->returnRegistration(request: $request);
    }

    public function registerPromoter(string $campaign, array $request): Registration|ValidationException
    {
        $request = $this->getClient()
            ->post("{$campaign}/promoter/register", $request);

        if ($request->clientError()) {
            throw ValidationException::withMessages($request->json()['errors']);
        }

        return $this->returnRegistration(request: $request);
    }

    public function register(string $campaign, array $request): Registration|ValidationException
    {
        $request = $this->getClient()
            ->post("{$campaign}/signup", $request);

        if ($request->clientError()) {
            throw ValidationException::withMessages($request->json()['errors']);
        }

        return $this->returnRegistration(request: $request);
    }

    public function resendVerificationEmail(string $campaign, string $registration)
    {
        $request = $this->getClient()->get("{$campaign}/registration/verify", [
            'registration' => $registration,

        ]);

        $this->handleRequest(request: $request);

        return $request->json('data');
    }

    public function verifyRegistration(string $campaign, string $registration)
    {
        $request = $this->getClient()->post("{$campaign}/registration/verify/email", [
            'registration' => $registration,
        ]);

        return $this->returnRegistration(request: $request);
    }

    /**
     * @throws ValidationException
     */
    public function returnRegistration($request): Registration|ValidationException
    {
        $this->handleRequest(request: $request);

        return new Registration($request->json('data'));
    }
}
