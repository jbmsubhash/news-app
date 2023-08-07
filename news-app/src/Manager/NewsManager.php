<?php
namespace App\Manager;

use App\Model\NewsResponse;

class NewsManager
{
    private iterable $newsProviders;

    public function __construct(iterable $newsProviders)
    {
        $this->newsProviders = $newsProviders;
    }

    public function fetchAllNews(?string $search): NewsResponse
    {
        $allNews = [];

        foreach ($this->newsProviders as $newsProvider) {
            $news = $newsProvider->fetchNews($search);
            if ($news) {
                $allNews = array_merge($allNews, $news);
            }
        }

        return $this->prepareResponsePayload($allNews);
    }

    public function prepareResponsePayload($allNews): NewsResponse
    {
        $newsResponse = new NewsResponse();
        $newsResponse->setNews($allNews['news']);
        $newsResponse->setCount(count($allNews['news']));
        return $newsResponse;
    }
}