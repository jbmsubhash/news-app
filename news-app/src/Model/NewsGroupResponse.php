<?php
namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;
use App\Model\NewsResponse;

class NewsGroupResponse
{
    /**
     * @var NewsResponse[]
     */
    public array $newsGroups;

    /**
     * @param array $newsGroups
     */
    public function setNewsGroups(array $newsGroups): void
    {
        $this->newsGroups = $newsGroups;
    }

}