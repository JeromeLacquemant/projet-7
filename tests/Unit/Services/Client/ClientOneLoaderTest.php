<?php

declare(strict_types=1);

namespace App\Tests\Unit\Services\Client;

use App\Entity\Client;
use App\Repository\ClientRepository;
use App\Services\Client\ClientOneLoader;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\SerializerInterface;

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

        $serializer = $this->createMock(SerializerInterface::class);
        $serializer
            ->expects($this->once())
            ->method('serialize')
            ->willReturn('{test}');

        $classToTest = new ClientOneLoader($clientRepository, $serializer);

        $id = 8;

        $this->assertIsString($classToTest->loadOneClient($id));
    }
}
