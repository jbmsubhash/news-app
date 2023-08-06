<?php

namespace App\Provider\NewsProvider;

use App\Client\HttpClient;
use App\Service\NewsResponseValidator;
use Exception;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;

class Guardian implements NewsProviderInterface
{

    public function __construct(
        private readonly string                $baseUrl,
        private readonly HttpClient            $httpClientService,
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
            'api-key' => 'abdb0d0f-f667-44c7-8c5a-bd6a2be00f3a',
            'q' => $search,
        ];

        $response = $this->httpClientService->get($this->baseUrl . '/search', $params);

        return $response['response']['results']??null;

    }
}