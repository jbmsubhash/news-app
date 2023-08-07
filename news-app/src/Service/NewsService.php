<?php
namespace App\Service;

use App\Entity\News;
use App\Model\BookmarkRequest;
use App\Model\NewsResponse;
use App\Repository\NewsRepository;
use Doctrine\ORM\EntityManagerInterface;
use DateTimeImmutable;

class NewsService
{
    private iterable $newsProviders;

    public function __construct(
        iterable $newsProviders,
        private readonly NewsRepository $newsRepository,
        protected EntityManagerInterface $entityManager
    ) {
        $this->newsProviders = $newsProviders;
    }

    public function fetchAllNews(?string $search): NewsResponse
    {
        $allNews = [];

        foreach ($this->newsProviders as $newsProvider) {
            $news = $newsProvider->fetchNews($search);
            if ($news) {
                $allNews = array_merge($allNews, $news);
            }
        }

        return $this->prepareResponsePayload($allNews);
    }

    public function save(BookmarkRequest $bookmarkRequest): ?News
    {
        $news = $this->newsRepository->findOneBy([
            'newsId' => $bookmarkRequest->getNewsId()
        ]);
        if(!$news){
            $news = new News();
            $news->setNewsId($bookmarkRequest->getNewsId());
            $news->setWebPublicationDate(new DateTimeImmutable($bookmarkRequest->getWebPublicationDate()));
            $news->setWebTitle($bookmarkRequest->getWebTitle());
            $news->setWebUrl($bookmarkRequest->getWebUrl());
            $this->entityManager->persist($news);
            $this->entityManager->flush();
        }
        return $news;
    }
}