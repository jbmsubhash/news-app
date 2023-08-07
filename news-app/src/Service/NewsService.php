<?php
namespace App\Service;

use App\Entity\News;
use App\Generator\ResponseGenerator;
use App\Model\BookmarkRequest;
use App\Model\NewsGroupsResponse;
use App\Repository\NewsRepository;
use Doctrine\ORM\EntityManagerInterface;
use DateTimeImmutable;
use Exception;

class NewsService
{
    private iterable $newsProviders;

    public function __construct(
        iterable $newsProviders,
        private readonly NewsRepository $newsRepository,
        protected EntityManagerInterface $entityManager,
        private readonly ResponseGenerator $newsResponseGenerator
    ) {
        $this->newsProviders = $newsProviders;
    }

    public function fetchAllNews(?string $search): NewsGroupsResponse
    {
        $groupedNewsArray = [];
        foreach ($this->newsProviders as $newsProvider) {
            $news = $newsProvider->fetchNews($search);
            if ($news) {
                $groupedNewsArray['newsGroups'][] = $news;
            }
        }
        return $this->newsResponseGenerator->prepareNewsGroupsResponse($groupedNewsArray);
    }

    /**
     * @throws Exception
     */
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