<?php
namespace App\Service;

use App\Model\NewsResponse as NewsResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Psr\Log\LoggerInterface;

class NewsResponseValidator
{

    public function __construct(
        private readonly SerializerInterface $serializer,
        private readonly ValidatorInterface $validator,
        private readonly LoggerInterface $logger
    ) {
    }

    /**
     * @throws Exception|DecodingExceptionInterface
     */
    public function validate(array $responseData): NewsResponse
    {
        $apiResponse = $this->serializer->deserialize(json_encode($responseData), NewsResponse::class, 'json');

        $violations = $this->validator->validate($apiResponse);

        if (count($violations) > 0) {
            $this->logger->error("Response payload failed to pass the contract validation");
        }

        return $apiResponse;
    }
}