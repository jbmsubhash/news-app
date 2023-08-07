<?php
namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;
use App\Model\News;

class NewsResponse
{
    public int $count;
    /**
     * @var News[]
     */
    public array $news;

    /**
     * @param int $count
     * @return int
     */
    public function setCount(int $count): int
    {
        return $this->count = $count;
    }

    /**
     * @param array $news
     * @return array
     */
    public function setNews(array $news): array
    {
        return $this->news = $news;
    }
}