<?php
namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;
use App\Model\News;

class NewsGroups
{
    public string $provider;
    /**
     * @var News[]
     */
    public array $news;

    /**
     * @param string $provider
     * @return string
     */
    public function setProvider(string $provider): string
    {
        return $this->provider = $provider;
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