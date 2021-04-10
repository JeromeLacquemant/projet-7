<?php

namespace App\Tests\Unit\Controller\Client;

use PHPUnit\Framework\TestCase;
use App\Responder\JsonResponder;
use Symfony\Component\HttpFoundation\Request;
use App\Controller\Client\ClientAllController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
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

        $jsonResponder = $this->createMock(JsonResponder::class);
        $jsonResponder
            ->expects($this->once())
            ->method('respond')
            ->willReturn(new JsonResponse);

        $classToTest = new ClientAllController($loader, $jsonResponder);

        $this->assertInstanceOf(Response::class, $classToTest->seeClients($request));
    }
    
}