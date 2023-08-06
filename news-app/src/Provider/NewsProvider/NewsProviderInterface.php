<?php
namespace App\Provider\NewsProvider;

interface NewsProviderInterface
{
    public function fetchNews(?string $search): ?array;
}