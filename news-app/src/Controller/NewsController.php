<?php
namespace App\Controller;

use App\Service\NewsService;
use App\Model\BookmarkRequest;
use App\Service\BookmarkService;
use App\Service\NewsResponseValidator;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends AbstractController
{

    public function __construct(
        private readonly NewsService $newsService,
        private readonly BookmarkService $bookmarkService
    ) {
    }

    #[Route('/news', name: 'news')]
    public function index(Request $request): Response
    {
        $search = $request->query->get('p');

        $allNews = $this->newsService->fetchAllNews($search??null);

        return new JsonResponse($allNews, Response::HTTP_OK);

    }

    /**
     * @throws Exception
     */
    #[Route('/bookmark', name: 'bookmark', methods: ['POST'])]
    public function bookmark(Request $request): Response
    {
        $bookmarkRequest = $this->bookmarkService->validateRequest($request);

        $news = $this->newsService->save($bookmarkRequest);

        $bookmark = $this->bookmarkService->save($bookmarkRequest, $news);

        if ($bookmark) {
            return new JsonResponse("Bookmark successfully added", Response::HTTP_OK);
        }
        return new JsonResponse("Unable to save bookmark", Response::HTTP_INTERNAL_SERVER_ERROR);

    }
}
