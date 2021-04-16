<?php

declare(strict_types=1);

namespace App\Tests\Unit\Services\Client;

use App\Entity\Client;
use PHPUnit\Framework\TestCase;
use App\Hateos\LinksConstructor;
use App\Repository\ClientRepository;
use App\Services\Client\ClientOneLoader;
use Symfony\Component\HttpFoundation\Request;

class ClientOneLoaderTest extends TestCase
{
    public function testUserOneLoader()
    {
        $client = new Client();
        
        $clientRepository = $this->createMock(ClientRepository::class);
        $clientRepository
            ->expects($this->once())
            ->method('find')
            ->willReturn($client);   

        $request = $this->createMock(Request::class);

        $linksConstructor = $this->createMock(LinksConstructor::class);

        $classToTest = new ClientOneLoader($clientRepository, $linksConstructor);

        $id = 8;

        $this->assertInstanceOf(Client::class, $classToTest->loadOneClient($id, $request));
    }
}