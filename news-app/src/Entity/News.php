<?php

namespace App\Entity;

use App\Repository\NewsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NewsRepository::class)]
#[ORM\Index(columns: ["news_id"], name: "news_id_idx")]
class News
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $newsId = null;

    #[ORM\Column(type: Types::DATETIMETZ_IMMUTABLE)]
    private ?\DateTimeImmutable $webPublicationDate = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $webTitle = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $webUrl = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNewsId(): ?string
    {
        return $this->newsId;
    }

    public function setNewsId(string $newsId): static
    {
        $this->newsId = $newsId;

        return $this;
    }

    public function getWebPublicationDate(): ?\DateTimeImmutable
    {
        return $this->webPublicationDate;
    }

    public function setWebPublicationDate(\DateTimeImmutable $webPublicationDate): static
    {
        $this->webPublicationDate = $webPublicationDate;

        return $this;
    }

    public function getWebTitle(): ?string
    {
        return $this->webTitle;
    }

    public function setWebTitle(?string $webTitle): static
    {
        $this->webTitle = $webTitle;

        return $this;
    }

    public function getWebUrl(): ?string
    {
        return $this->webUrl;
    }

    public function setWebUrl(?string $webUrl): static
    {
        $this->webUrl = $webUrl;

        return $this;
    }
}
