<?php

namespace App\Provider\NewsProvider;

use App\Client\HttpClient;
use App\Model\Nested\Guardian as GuardianModel;
use Exception;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;

class Guardian implements NewsProviderInterface
{

    public function __construct(
        private readonly string $baseUrl,
        private readonly string $apiKey,
        private readonly HttpClient $httpClientService,
        private readonly SerializerInterface $serializer,
        private readonly ValidatorInterface $validator
    ) {
    }

    /**
     * @throws Exception
     * @throws DecodingExceptionInterface
     */
    public function fetchNews(?string $search): array
    {
        $params = [
            'api-key' => $this->apiKey,
            'q' => $search,
        ];

        $responseArray = $this->httpClientService->get($this->baseUrl . '/search', $params);

        return $this->validate($responseArray);

    }

    public function validate(array $responseArray): array
    {
        if (isset($responseArray['response']['results'])) {
            $modifiedArray = [
                'news' => $responseArray['response']['results']
            ];
            $deserializedObject = $this->serializer->deserialize(json_encode($modifiedArray), GuardianModel::class, 'json');
            $violations = $this->validator->validate($deserializedObject);

            if (count($violations) > 0) {
                $this->logger->error("Response payload failed to pass the contract validation");
                return [];
            }

            return $this->serializer->normalize($deserializedObject);
        };
        return [];
    }
}