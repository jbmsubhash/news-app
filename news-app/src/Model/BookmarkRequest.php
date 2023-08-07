<?php
namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class BookmarkRequest
{
    /**
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    public string $userId;

    /**
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    public string $newsId;

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

    /**
     * @return string
     */
    public function getNewsId(): string
    {
        return $this->newsId;
    }

    /**
     * @param string $newsId
     * @return BookmarkRequest
     */
    public function setNewsId(string $newsId): self
    {
        $this->newsId = $newsId;
        return $this;
    }

    /**
     * @return string
     */
    public function getWebPublicationDate(): string
    {
        return $this->webPublicationDate;
    }

    /**
     * @param string $webPublicationDate
     * @return BookmarkRequest
     */
    public function setWebPublicationDate(string $webPublicationDate): self
    {
        $this->webPublicationDate = $webPublicationDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getWebTitle(): string
    {
        return $this->webTitle;
    }

    /**
     * @param string $webTitle
     * @return BookmarkRequest
     */
    public function setWebTitle(string $webTitle): self
    {
        $this->webTitle = $webTitle;
        return $this;
    }

    /**
     * @return string
     */
    public function getWebUrl(): string
    {
        return $this->webUrl;
    }

    /**
     * @param string $webUrl
     * @return BookmarkRequest
     */
    public function setWebUrl(string $webUrl): self
    {
        $this->webUrl = $webUrl;
        return $this;
    }
}