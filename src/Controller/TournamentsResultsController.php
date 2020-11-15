<?php

declare(strict_types=1);

namespace App\Controller;

use App\Infrastructure\Doctrine\Repository\TournamentsResultsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TournamentsResultsController extends AbstractController
{
    /**
     * @Route("/tournaments/results", name="tournaments_results")
     */
    public function index(TournamentsResultsRepository $tournamentsResultsRepository)
    {
        $results = $tournamentsResultsRepository->items();

        return $this->render('tournaments_results/index.html.twig', [
            'results' => $results
        ]);
    }
}
