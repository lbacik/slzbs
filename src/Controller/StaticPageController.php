<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\StaticPage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/page")
 */
class StaticPageController extends AbstractController
{
    /**
     * @var StaticPage
     */
    private $staticPage;

    public function __construct(StaticPage $staticPage)
    {
        $this->staticPage = $staticPage;
    }

    /**
     * @Route("/show/{id}", name="static_page_show")
     */
    public function show(string $id): Response
    {
        $page = $this->staticPage->get($id);

        return $this->render(
            'static/show.html.twig',
            [
                'page' => $page,
            ]
        );
    }
}
