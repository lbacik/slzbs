<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\StaticPage;
use App\Service\StaticPage\Exception\StaticPageException;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/page")
 */
class StaticPageController extends AbstractController
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var StaticPage
     */
    private $staticPage;

    public function __construct(
        LoggerInterface $logger,
        StaticPage $staticPage
    ) {
        $this->logger = $logger;
        $this->staticPage = $staticPage;
    }

    /**
     * @Route("/show/{id}", name="static_page_show")
     */
    public function show(int $id): Response
    {
        try {
            $page = $this->staticPage->get($id);
        } catch (StaticPageException $exception) {
            $this->logger->error($exception->getMessage());
            throw new HttpException(404);
        }

        return $this->render(
            'static/show.html.twig',
            [
                'page' => $page,
            ]
        );
    }
}
