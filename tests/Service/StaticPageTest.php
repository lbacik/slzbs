<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Entity\StaticPage as StaticPageEntity;
use App\Service\StaticPage;
use App\ValueObject\Identification;
use PHPUnit\Framework\TestCase;

class StaticPageTest extends TestCase
{
    const ID = 'id';

    /** @var StaticPage */
    private $staticPage;

    /** @var StaticPage\Repository */
    private $repository;

    public function setUp(): void
    {
        $this->repository = $this->createMock(StaticPage\Repository::class);
        $this->staticPage = new StaticPage($this->repository);
    }

    public function testGet(): void
    {
        $identification = Identification::create(self::ID);
        $expected = new StaticPageEntity();
        $this->repository
            ->expects($this->once())
            ->method('get')
            ->with($this->equalTo($identification))
            ->willReturn($expected);
        $entity = $this->staticPage->get(self::ID);
        $this->assertSame($expected, $entity);
    }
}
