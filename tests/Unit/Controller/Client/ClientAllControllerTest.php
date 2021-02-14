<?php

use PHPUnit\Framework\TestCase;
use App\Controller\Client\ClientAllController;
use Symfony\Component\HttpFoundation\Response;
use App\Services\Client\Interfaces\ClientAllLoaderInterface;

class ClientAllControllerTest extends TestCase
{
    public function testProductAllController() 
    {
        $loader = $this->createMock(ClientAllLoaderInterface::class);
        $loader
            ->expects($this->once())
            ->method('loadAllClients');

        $classToTest = new ClientAllController($loader);

        $this->assertInstanceOf(Response::class, $classToTest->seeClients());
    }
    
}