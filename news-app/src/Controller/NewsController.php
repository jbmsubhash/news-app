<?php
namespace App\Controller;

use App\Manager\NewsManager;
use App\Service\NewsResponseValidator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends AbstractController
{

    #[Route('/news', name: 'news')]
    public function index(Request $request, NewsManager $newsManager, NewsResponseValidator $newsResponseValidator): Response
    {
//        if (!$this->getUser()) {
//            return $this->redirectToRoute('app_login');
//        }
        $search = $request->query->get('p');

        $allNews = $newsManager->fetchAllNews($search??null);

        $responseArray = [
            'count' => count($allNews),
            'news' => $allNews
        ];

        return new JsonResponse($newsResponseValidator->validate($responseArray));

    }

    #[Route('/bookmark', name: 'bookmark')]
    public function bookmark(Request $request): Response
    {
        echo "TODO";
////        if (!$this->getUser()) {
////            return $this->redirectToRoute('app_login');
////        }
//        $search = $request->query->get('p');
//
//        $allNews = $newsManager->fetchAllNews($search??null);
//
//        $responseArray = [
//            'count' => count($allNews),
//            'news' => $allNews
//        ];
//
//        return new JsonResponse($newsResponseValidator->validate($responseArray));

    }
}
