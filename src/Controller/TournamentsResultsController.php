<?php

declare(strict_types=1);

namespace App\Controller;

use App\Infrastructure\Doctrine\Repository\TournamentsResultsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TournamentsResultsController extends AbstractController
{
    public const QUERY_PAGE = 'page';
    public const QUERY_LIMIT = 'limit';

    private const DEFAULT_QUERY_PAGE = 1;
    private const DEFAULT_QUERY_LIMIT = 10;

    /**
     * @Route("/tournaments/results", name="tournaments_results")
     */
    public function index(
        Request $request,
        TournamentsResultsRepository $tournamentsResultsRepository
    ): Response {

        $page = (int) $request->query->get(self::QUERY_PAGE, self::DEFAULT_QUERY_PAGE);
        $limit = (int) $request->query->get(self::QUERY_LIMIT, self::DEFAULT_QUERY_LIMIT);

        $paginator = $tournamentsResultsRepository->items($limit, ($page - 1) * $limit);

        $paginatorTotal = $paginator->count();
        $query = [
            'limit' => $limit,
        ];

        $uri = $this->generateUrl('tournaments_results', $query);

        $parameters = [
            'results' => $paginator,
            'paginator' => [
                'total' => $paginatorTotal,
                'page' => $page,
                'perPage' => $limit,
                'totalPages' => (int) ceil($paginatorTotal / $limit),
                'steps' => 2,
                'uri' => $uri,
            ],
            'paginatorShow' => false,
        ];

        if ($paginatorTotal > $limit) {
            $parameters['paginatorShow'] = true;
        }

        return $this->render('tournaments_results/index.html.twig', $parameters);
    }
}
