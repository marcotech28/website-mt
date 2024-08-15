<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class RecaptchaValidator
{
    private $httpClient;
    private $secretKey;

    public function __construct(HttpClientInterface $httpClient, string $secretKey)
    {
        $this->httpClient = $httpClient;
        $this->secretKey = $secretKey;
    }

    public function validate(string $recaptchaResponse): bool
    {
        $response = $this->httpClient->request('POST', 'https://www.google.com/recaptcha/api/siteverify', [
            'body' => [
                'secret' => $this->secretKey,
                'response' => $recaptchaResponse
            ]
        ]);

        $content = $response->toArray();

        return $content['success'] ?? false;
    }
}
