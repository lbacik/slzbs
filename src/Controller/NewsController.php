<?php

namespace App\Controller;

use App\Infrastructure\Doctrine\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends AbstractController
{
    /**
     * @Route("/news", name="news")
     */
    public function index(NewsRepository $newsRepository)
    {
        $news = $newsRepository->items();

        return $this->render('news/index.html.twig', [
            'controller_name' => 'NewsController',
            'news' => $news,
        ]);
    }
}
