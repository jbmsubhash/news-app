<?php
namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;
use App\Model\News;

class NewsResponse
{
    public int $provider;
    /**
     * @var News[]
     */
    public array $news;

}