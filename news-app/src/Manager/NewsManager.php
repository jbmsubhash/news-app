<?php
namespace App\Manager;

class NewsManager
{
    private iterable $newsProviders;

    public function __construct(iterable $newsProviders)
    {
        $this->newsProviders = $newsProviders;
    }

    public function fetchAllNews(?string $search): array
    {
        $allNews = [];

        foreach ($this->newsProviders as $newsProvider) {
            $news = $newsProvider->fetchNews($search);
            if($news) {
                $allNews = array_merge($allNews, $news);
            }
        }

        return $allNews;
    }
}