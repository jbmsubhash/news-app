<?php
namespace App\Provider\NewsProvider;

use App\Model\BookmarkResponse;

interface NewsProviderInterface
{
    public function fetchNews(?string $search): array;
    public function validate(array $responseArray): array;
}