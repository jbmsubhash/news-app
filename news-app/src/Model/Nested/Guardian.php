<?php
namespace App\Model\Nested;

use App\Model\Nested\GuardianNews;
use Symfony\Component\Validator\Constraints as Assert;

class Guardian
{
    public string $provider;
    /**
     * @var GuardianNews[]
     */
    public array $news;
}