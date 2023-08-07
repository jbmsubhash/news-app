<?php
namespace App\Generator;

use App\Model\NewsGroups;
use App\Model\NewsGroupsResponse;
use App\Model\BookmarkResponse;

class ResponseGenerator {

    public function prepareBookmarkResponse(array $allNews): BookmarkResponse
    {
        $newsResponse = new BookmarkResponse();
        $newsResponse->setNews($allNews['news']);
        $newsResponse->setCount(count($allNews['news']));
        return $newsResponse;
    }

    public function prepareNewsGroupsResponse(array $allNews): NewsGroupsResponse
    {
        $newsGroupsArray = [];
        foreach ($allNews['newsGroups'] as $news){
            $newsGroups = new NewsGroups();
            $newsGroups->setNews($news['news']);
            $newsGroups->setProvider($news['provider']);
            $newsGroupsArray[] = $newsGroups;
        }
        $newsGroupResponse = new NewsGroupsResponse();
        $newsGroupResponse->setNewsGroups($newsGroupsArray);
        return $newsGroupResponse;
    }
}
