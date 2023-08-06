<?php

namespace App\Provider\NewsProvider;

use App\Client\HttpClient;
use App\Service\NewsResponseValidator;
use Exception;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;

class Guardian implements NewsProviderInterface
{

    public function __construct(
        private readonly string $baseUrl,
        private readonly string $apiKey,
        private readonly HttpClient $httpClientService,
        private readonly NewsResponseValidator $newsResponseValidator
    ) {
    }

    /**
     * @throws Exception
     * @throws DecodingExceptionInterface
     */
    public function fetchNews(?string $search): ?array
    {
        $params = [
            'api-key' => $this->apiKey,
            'q' => $search,
        ];

        $response = $this->httpClientService->get($this->baseUrl . '/search', $params);

        return $response['response']['results']??null;

    }
}