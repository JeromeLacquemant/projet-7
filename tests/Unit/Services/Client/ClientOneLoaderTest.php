<?php

declare(strict_types=1);

namespace App\Tests\Unit\Services\Client;

use App\Entity\Client;
use PHPUnit\Framework\TestCase;
use App\Repository\ClientRepository;
use App\Services\Client\ClientOneLoader;
use Symfony\Component\HttpFoundation\Request;
use App\Output\OutputConstructors\ClientOneOutputConstruction;
use App\Output\Outputs\ClientOutput;

class ClientOneLoaderTest extends TestCase
{
    public function testUserOneLoader()
    {
        $client = new Client();
        $clientOutput = new ClientOutput();
        
        $clientRepository = $this->createMock(ClientRepository::class);
        $clientRepository
            ->expects($this->once())
            ->method('find')
            ->willReturn($client);   

        $request = $this->createMock(Request::class);

        $clientOneOutputConstruction = $this->createMock(ClientOneOutputConstruction::class);
        $clientOneOutputConstruction
            ->expects($this->once())
            ->method('outputConstruction')
            ->willReturn($clientOutput); 

        $classToTest = new ClientOneLoader($clientRepository, $clientOneOutputConstruction);

        $id = 1;

        $this->assertInstanceOf(ClientOutput::class, $classToTest->loadOneClient($id, $request));
    }
}