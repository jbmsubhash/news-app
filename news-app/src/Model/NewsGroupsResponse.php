<?php
namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;
use App\Model\News;

class NewsGroupsResponse
{

    /**
     * @var NewsGroups[]
     */
    public array $newsGroups;

    /**
     * @param array $newsGroups
     * @return array
     */
    public function setNewsGroups(array $newsGroups): array
    {
        return $this->newsGroups = $newsGroups;
    }
}