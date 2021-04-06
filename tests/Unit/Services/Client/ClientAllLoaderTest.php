<?php

declare(strict_types=1);

namespace App\Tests\Unit\Services\Client;

use PHPUnit\Framework\TestCase;
use App\Repository\ClientRepository;
use App\Services\Client\ClientAllLoader;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\InputBag;

class ClientAllLoaderTest extends TestCase
{
    public function testProductAllLoader()
    {
        $clientRepository = $this->createMock(ClientRepository::class);
        $clientRepository
            ->expects($this->once())
            ->method('getClients')
            ->willReturn(new Paginator(1));

        $request = $this->createMock(Request::class);
        $request->query = new InputBag;

        $classToTest = new ClientAllLoader($clientRepository);

        $this->assertInstanceOf(Paginator::class, $classToTest->loadAllClients($request));
    }
}