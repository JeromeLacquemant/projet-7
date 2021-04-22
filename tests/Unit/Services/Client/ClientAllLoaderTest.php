<?php

declare(strict_types=1);

namespace App\Tests\Unit\Services\Client;

use PHPUnit\Framework\TestCase;
use App\Repository\ClientRepository;
use App\Services\Client\ClientAllLoader;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\InputBag;
use App\Output\OutputConstructors\ClientAllOutputConstruction;
use App\Output\Outputs\ClientOutput;

class ClientAllLoaderTest extends TestCase
{
    public function testProductAllLoader()
    {
        $clientOutput = new ClientOutput();

        $clientRepository = $this->createMock(ClientRepository::class);
        $clientRepository
            ->expects($this->once())
            ->method('getClients');

        $request = $this->createMock(Request::class);
        $request->query = new InputBag;

        $clientAllOutputConstruction = $this->createMock(ClientAllOutputConstruction::class);
        $clientAllOutputConstruction
            ->expects($this->once())
            ->method('outputConstruction')
            ->willReturn($clientOutput); 

        $classToTest = new ClientAllLoader($clientRepository, $clientAllOutputConstruction);

        $this->assertEquals($clientOutput, $classToTest->loadAllClients($request));
    }
}