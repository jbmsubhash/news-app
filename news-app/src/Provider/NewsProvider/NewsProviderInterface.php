<?php
namespace App\Provider\NewsProvider;

use App\Model\NewsResponse;

interface NewsProviderInterface
{
    public function fetchNews(?string $search): array;
    public function validate(array $responseArray): array;
}