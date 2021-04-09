<?php

declare(strict_types=1);

namespace App\Tests\Unit\Services\Client;

use App\Entity\Client;
use PHPUnit\Framework\TestCase;
use App\Repository\ClientRepository;
use App\Services\Client\ClientOneLoader;

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

        $classToTest = new ClientOneLoader($clientRepository);

        $id = 8;

        $this->assertInstanceOf(Client::class, $classToTest->loadOneClient($id));
    }
}