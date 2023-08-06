<?php
namespace App\Client;

use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HttpClient
{
    const HTTP_OK = 200;

    public function __construct(
        private readonly HttpClientInterface $httpClient,
        private readonly LoggerInterface $logger)
    {
    }

    /**
     * @throws Exception|DecodingExceptionInterface
     */
    public function get(string $url, array $queryParameters = []): ?array
    {
        try {
            $response =  $this->httpClient->request('GET', $url, [
                'query' => $queryParameters,
            ]);
            if($response->getStatusCode()=== self::HTTP_OK){
                return $response->toArray();
            }
            $this->logger->info(sprintf('Unsuccessful api call to %s',$url));
            return null;
        } catch (TransportExceptionInterface $e) {
            throw new Exception('Could not connect to the endpoint');
        }
    }
}