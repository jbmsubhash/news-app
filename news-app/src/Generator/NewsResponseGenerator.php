<?php
namespace App\Generator;

use App\Model\NewsResponse;

class NewsResponseGenerator {

    public function __construct()
    {
    }

    public function prepareNewsResponse($allNews): NewsResponse
    {
        $newsResponse = new NewsResponse();
        $newsResponse->setNews($allNews['news']);
        $newsResponse->setCount(count($allNews['news']));
        return $newsResponse;
    }
}
