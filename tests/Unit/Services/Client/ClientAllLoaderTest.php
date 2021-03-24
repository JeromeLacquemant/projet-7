<?php

declare(strict_types=1);

namespace App\Tests\Unit\Services\Client;

use PHPUnit\Framework\TestCase;
use App\Repository\ClientRepository;
use App\Services\Client\ClientAllLoader;
use Symfony\Component\HttpFoundation\InputBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

class ClientAllLoaderTest extends TestCase
{
    public function testProductAllLoader()
    {
        $serializer = $this->createMock(SerializerInterface::class);
        $serializer
            ->expects($this->once())
            ->method('serialize')
            ->willReturn('{test}');

        $productRepository = $this->createMock(ClientRepository::class);

        $request = $this->createMock(Request::class);
        $request->query = new InputBag;

        $classToTest = new ClientAllLoader($productRepository, $serializer);

        $this->assertIsString($classToTest->loadAllClients($request));
    }
}