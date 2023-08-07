<?php
namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;
use App\Model\News;

class BookmarkResponse
{
    public int $count;
    /**
     * @var News[]
     */
    public array $news;

    /**
     * @return array
     */
    public function getNews(): array
    {
        return $this->news;
    }

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

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }
}