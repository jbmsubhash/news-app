<?php

namespace App\Entity;

use App\Repository\UserBookmarkRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserBookmarkRepository::class)]
#[ORM\UniqueConstraint(name: "unique_userid_news_id_idx", columns: ["user_id", "news_id"], )]
class UserBookmark
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'user')]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id', nullable: false)]
    private User $user;

    #[ORM\ManyToOne(targetEntity: News::class, inversedBy: 'news')]
    #[ORM\JoinColumn(name: 'news_id', referencedColumnName: 'id', nullable: false)]
    private News $news;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->user;
    }

    public function setUser(User $user): UserBookmark
    {
        $this->user = $user;

        return $this;
    }

    public function getNews(): ?int
    {
        return $this->news;
    }

    public function setNews(News $news): UserBookmark
    {
        $this->news = $news;

        return $this;
    }
}
