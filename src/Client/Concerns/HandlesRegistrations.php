<?php

namespace ContestKit\Sdk\Client\Concerns;

use Illuminate\Validation\ValidationException;
use ContestKit\Sdk\Data\Registration\Registration;

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

        $data = $request->json('data');

        return new Registration([
            'external_id' => data_get($data, 'id'),
            'name' => data_get($data, 'first_name').' '.data_get($data, 'last_name'),
            'email' => data_get($data, 'email_address'),
            'bare_email' => data_get($data, 'bare_email'),
            'token' => data_get($data, 'token'),
            'registered_at' => data_get($data, 'created_at'),
            'verified' => data_get($data, 'verified'),
            'email_verified_at' => data_get($data, 'verified_at'),
            'credits' => data_get($data, 'credits.count'),
            'credits_daily_allotment' => data_get($data, 'credits.daily_allotment'),
            'last_played_at' => data_get($data, 'credits.last_played_at'),
            'play_again_at' => data_get($data, 'credits.play_again_at'),
            'referral' => data_get($data, 'referral'),
            'winner' => data_get($data, 'winner'),
        ]);
    }

}