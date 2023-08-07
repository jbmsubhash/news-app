<?php
namespace App\Controller;

use App\Service\NewsService;
use App\Service\NewsResponseValidator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends AbstractController
{

    public function __construct(
        private readonly NewsService $newsService,
    ) {
    }

    #[Route('/news', name: 'news', methods: ['GET'])]
    public function index(Request $request): Response
    {
        $search = $request->query->get('p');

        $allNews = $this->newsService->fetchAllNews($search??null);

        return new JsonResponse($allNews, Response::HTTP_OK);

    }
}
