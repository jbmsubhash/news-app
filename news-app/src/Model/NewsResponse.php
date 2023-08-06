<?php
namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;
use App\Model\Nested\News;

class NewsResponse
{
    /**
     * @Assert\NotBlank
     * @Assert\Type("integer")
     */
    public int $count;

    /**
     * @var News[]
     */
    public array $news;
}