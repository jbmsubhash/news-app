<?php
namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class BookmarkListRequest
{
    /**
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    public string $userId;

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @param string $userId
     */
    public function setUserId(string $userId): void
    {
        $this->userId = $userId;
    }
}