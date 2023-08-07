<?php
namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;
use App\Model\News;

class NewsResponse
{
    /**
     * @var News[]
     */
    public array $news;

}