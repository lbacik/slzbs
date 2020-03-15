<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Entity\MenuItem;
use App\Service\Menu;
use App\Service\MenuItemRepository;
use PHPUnit\Framework\TestCase;

class MenuTest extends TestCase
{
    /** @var Menu */
    private $menu;

    /** @var MenuItemRepository */
    private $itemRepositoryMock;

    public function setUp(): void
    {
        $this->itemRepositoryMock = $this->createMock(MenuItemRepository::class);
        $this->menu = new Menu($this->itemRepositoryMock);
    }

    public function testItems(): void
    {
        $expected = Menu\MenuItemCollection::create([
            new MenuItem('foo', '/foo', true),
            new MenuItem('bar', '/bar', false),
        ]);

        $this
            ->itemRepositoryMock
            ->expects($this->once())
            ->method('items')
            ->willReturn($expected);

        $this->assertTrue($this->menu->items()->isEqual($expected));
    }
}
