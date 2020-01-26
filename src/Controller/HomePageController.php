<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class HomePageController extends AbstractController
{
    /**
     * @Route("/", name="index_page")
     */
    public function index(): Response
    {
        return $this->render(
            'base.html.twig'
        );
    }
}
