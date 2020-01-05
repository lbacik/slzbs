<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Entity\StaticPage as StaticPageEntity;
use App\Service\StaticPage;
use App\Service\StaticPageRepository;
use App\ValueObject\Identification;
use PHPUnit\Framework\TestCase;

class StaticPageTest extends TestCase
{
    const ID = 3;

    /** @var StaticPage */
    private $staticPage;

    /** @var StaticPageRepository */
    private $repository;

    public function setUp(): void
    {
        $this->repository = $this->createMock(StaticPageRepository::class);
        $this->staticPage = new StaticPage($this->repository);
    }

    public function testGet(): void
    {
        $expected = new StaticPageEntity();
        $this->repository
            ->expects($this->once())
            ->method('get')
            ->with($this->equalTo(self::ID))
            ->willReturn($expected);
        $entity = $this->staticPage->get(self::ID);
        $this->assertSame($expected, $entity);
    }
}
