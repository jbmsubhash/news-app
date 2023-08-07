<?php
namespace App\Controller;

use App\Service\NewsService;
use App\Service\BookmarkService;
use App\Service\NewsResponseValidator;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookmarkController extends AbstractController
{

    public function __construct(
        private readonly NewsService $newsService,
        private readonly BookmarkService $bookmarkService
    ) {
    }

    /**
     * @throws Exception
     */
    #[Route('/api/bookmarks', name: 'add_bookmark', methods: ['POST'])]
    public function bookmark(Request $request): Response
    {
        $bookmarkRequest = $this->bookmarkService->validateRequest($request);

        $news = $this->newsService->save($bookmarkRequest);

        $bookmark = $this->bookmarkService->save($bookmarkRequest, $news);

        if ($bookmark) {
            return new JsonResponse("Bookmark successfully added", Response::HTTP_OK);
        }
        return new JsonResponse("Unable to save bookmark", Response::HTTP_BAD_REQUEST);

    }

    /**
     * @throws Exception
     */
    #[Route('/api/bookmarks', name: 'list_bookmark', methods: ['GET'])]
    public function listBookmarks(Request $request): Response
    {
        $bookmarkRequest = $this->bookmarkService->validateListRequest($request);

        $bookmarkList = $this->bookmarkService->list($bookmarkRequest);

        if ($bookmarkList) {
            return new JsonResponse($bookmarkList, Response::HTTP_BAD_REQUEST);
        }
        return new JsonResponse("Unable to retrieve bookmarks for this user.", Response::HTTP_BAD_REQUEST);
    }
}
