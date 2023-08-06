<?php
namespace App\Model\Nested;

use Symfony\Component\Validator\Constraints as Assert;

class News
{
    /**
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    public string $id;

    /**
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    public string $webPublicationDate;

    /**
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    public string $webTitle;

    /**
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    public string $webUrl;
}