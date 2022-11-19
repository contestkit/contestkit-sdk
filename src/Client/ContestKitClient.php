<?php

namespace ContestKit\Sdk\Client;

use ContestKit\Sdk\Data\Registration\Registration;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

class ContestKitClient
{
    public function __construct(protected array $config)
    {
    }

    protected function getClient()
    {
        return Http::withHeaders(
            array_merge(data_get($this->config, 'headers'), [
                'X-ContestKit-Host' => request()->getHttpHost(),
            ])
        )->withToken(data_get($this->config, 'access_token'))
            ->baseUrl(data_get($this->config, 'base_url'));
    }

    public function campaign(string $campaign)
    {
        $request = $this->getClient()
            ->get("{$campaign}/campaign");

        $this->handleRequest(request: $request);

        return $request->json('data');
    }

    public function page(string $campaign, string $page)
    {
        return $this->getClient()
            ->get("{$campaign}/page/{$page}")->json();
    }

    public function pageBlocks(string $campaign, string $page)
    {
        return $this->getClient()
            ->get("{$campaign}/page-blocks/{$page}")->json();
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

    public function me(string $campaign, string $registration): Registration|ValidationException
    {
        $request = $this->getClient()->get("{$campaign}/me/{$registration}");

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

    /**
     * @throws ValidationException
     */
    public function handleRequest($request)
    {
//        ray($request);
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

    public function publicDraws(string $campaign)
    {
        $request = $this->getClient()->get("{$campaign}/draw");

        return $request->json('data');
    }

    public function publicDraw(string $campaign, string $draw)
    {
        $request = $this->getClient()->get("{$campaign}/draw/{$draw}");

        return $request->json('data');
    }

    public function draws(string $campaign, string $registration)
    {
        $request = $this->getClient()
            ->get("{$campaign}/draws", [
                'registration' => $registration,
            ]);

        return $request->json('data');
    }

    public function winners(string $campaign)
    {
        $request = $this->getClient()
            ->get("{$campaign}/winners");

        $this->handleRequest(request: $request);

        return $request->json('data');
    }

    public function prizes(string $campaign)
    {
        $request = $this->getClient()
            ->get("{$campaign}/prizes");

        $this->handleRequest(request: $request);

        return $request->json('data');
    }

    public function draw(string $campaign, string $draw, string $registration)
    {
        $request = $this->getClient()
            ->get("{$campaign}/draws/{$draw}", [
                'registration' => $registration,
            ]);

        $this->handleRequest(request: $request);

        return $request->json('data');
    }

    public function autoSelectNumbersForDraw(string $campaign, string $draw, string $registration)
    {
        $request = $this->getClient()
            ->post("{$campaign}/draws/{$draw}/quick-pick", [
                'registration' => $registration,
            ]);

        return $this->handleRequest(request: $request);
    }

    public function selectNumbersForDraw(string $campaign, string $draw, string $registration, array $numbers)
    {
        $request = $this->getClient()
            ->post("{$campaign}/draws/{$draw}", [
                'registration' => $registration,
                'numbers' => $numbers,
            ]);

        return $this->handleRequest(request: $request);
    }

    public function pull(string $campaign, string $registration)
    {
        $request = $this->getClient()->post("{$campaign}/scratch", [
            'registration' => $registration,
        ]);

        $this->handleRequest(request: $request);

        return $request->json('data');
    }

    public function verify(string $campaign, string $registration, string $game)
    {
        $request = $this->getClient()->patch("{$campaign}/scratch", [
            'registration' => $registration,
            'game' => $game,
        ]);

        $this->handleRequest(request: $request);

        return $request->json('data');
    }

    public function referral(string $campaign, string $referral)
    {
        $request = $this->getClient()->get("{$campaign}/referral", [
            'referral' => $referral,

        ]);

        $this->handleRequest(request: $request);

        return $request->json('data');
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
}
