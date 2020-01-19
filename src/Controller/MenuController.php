<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\Menu;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class MenuController extends AbstractController
{
    /** @var Menu */
    private $menu;

    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
    }

    public function menu(): Response
    {
        $items = $this->menu->items();

        return $this->render(
            'menu.html.twig',
            [
                'items' => $items,
            ]
        );
    }
}
