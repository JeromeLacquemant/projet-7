<?php

namespace App\Tests\Unit\Client;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
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

        $request = $this->createMock(Request::class);

        $classToTest = new ClientAllController($loader);

        $this->assertInstanceOf(Response::class, $classToTest->seeClients($request));
    }
    
}