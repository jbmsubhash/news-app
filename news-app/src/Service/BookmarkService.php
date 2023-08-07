<?php
namespace App\Service;

use App\Entity\News;
use App\Entity\UserBookmark;
use App\Model\BookmarkListRequest;
use App\Model\BookmarkRequest;
use App\Model\NewsResponse;
use App\Repository\UserBookmarkRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class BookmarkService
{
    public function __construct(
        private readonly ValidatorInterface $validator,
        private readonly UserBookmarkRepository $userBookmarkRepository,
        private readonly UserRepository $userRepository,
        private readonly NewsService $newsService,
        protected EntityManagerInterface $entityManager,
        private readonly LoggerInterface $logger)
    {
    }

    /**
     * @throws Exception
     */
    public function validateRequest(Request $request): BookmarkRequest
    {
        $bookmarkRequest = new BookmarkRequest();
        $bookmarkRequest->userId = $request->query->get('userId');
        $bookmarkRequest->newsId = $request->query->get('newsId');
        $bookmarkRequest->webPublicationDate = $request->query->get('webPublicationDate');
        $bookmarkRequest->webTitle = $request->query->get('webTitle');
        $bookmarkRequest->webUrl = $request->query->get('webUrl');

        $errors = $this->validator->validate($bookmarkRequest);

        if (count($errors) > 0) {
             throw new Exception("Invalid request");
        }
        return $bookmarkRequest;
    }
    /**
     * @throws Exception
     */
    public function validateListRequest(Request $request): BookmarkListRequest
    {
        $bookmarkListRequest = new BookmarkListRequest();
        $bookmarkListRequest->userId = $request->query->get('userId');

        $errors = $this->validator->validate($bookmarkListRequest);

        if (count($errors) > 0) {
            throw new Exception("Invalid request");
        }
        return $bookmarkListRequest;
    }


    public function save(BookmarkRequest $bookmarkRequest, News $news): ?UserBookmark
    {
        $user = $this->userRepository->findOneBy([
            'id' => $bookmarkRequest->getUserId(),
        ]);

        if(!$user) {
            $this->logger->error("User does not exist in the database");
            return null;
        }

        $userBookmark = $this->userBookmarkRepository->findOneBy([
            'user' => $user,
            'news' => $news,
        ]);

        if(!$userBookmark){
            $userBookmark = new UserBookmark();
            $userBookmark->setNews($news);
            $userBookmark->setUser($user);

            $this->entityManager->persist($userBookmark);
            $this->entityManager->flush();
        }
        return $userBookmark;
    }

    public function list(BookmarkListRequest $bookmarkListRequest): ?NewsResponse
    {
        $user = $this->userRepository->findOneBy([
            'id' => $bookmarkListRequest->getUserId(),
        ]);

        if(!$user) {
            $this->logger->error("User does not exist in the database");
            return null;
        }

        $userBookmarks = $this->userBookmarkRepository->findBy([
            'user' => $user,
        ]);
        if(!$userBookmarks){
            return null;
        }
        $allNews = [];
        $news = [];
        foreach ($userBookmarks as $userBookmark){
            $news['id'] = $userBookmark->getNews()->getId();
            $news['webPublicationDate'] = $userBookmark->getNews()->getWebPublicationDate()->format('Y-m-d H:i:s');
            $news['webTitle'] = $userBookmark->getNews()->getWebTitle();
            $news['webUrl'] = $userBookmark->getNews()->getWebUrl();
            $allNews['news'][] = $news;
        }
        return $this->newsService->prepareResponsePayload($allNews);
    }
}