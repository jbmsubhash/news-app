<?php
namespace App\Generator;

use App\Model\NewsGroupResponse;
use App\Model\NewsResponse;

class NewsResponseGenerator {

    public function prepareNewsResponse($allNews): NewsGroupResponse
    {
        $newsResponse = new NewsResponse();
        $newsResponse->setNews($allNews['news']);
        $newsResponse->setProvider($allNews['news']);

        $newsResponse = new NewsGroupResponse();

        $newsResponse->setNews($allNews['news']);
        $newsResponse->setNe(count($allNews['news']));
        return $newsResponse;
    }
}
