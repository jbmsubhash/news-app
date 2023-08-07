<?php
namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class News
{
    #[Assert\NotBlank]
    #[Assert\Type(type: 'string')]
    public string $id;

    #[Assert\NotBlank]
    #[Assert\Type(type: 'string')]
    public string $webPublicationDate;

    #[Assert\NotBlank]
    #[Assert\Type(type: 'string')]
    public string $webTitle;

    #[Assert\NotBlank]
    #[Assert\Type(type: 'string')]
    public string $webUrl;
}