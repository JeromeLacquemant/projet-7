<?php

namespace App\Tests\Unit\Controller\Client;

use PHPUnit\Framework\TestCase;
use App\Responder\JsonResponder;
use Symfony\Component\HttpFoundation\Request;
use App\Controller\Client\ClientOneController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Services\Client\Interfaces\ClientOneLoaderInterface;

class ClientOneControllerTest extends TestCase
{
    public function testClientOneController() 
    {
        $loader = $this->createMock(ClientOneLoaderInterface::class);
        $loader
            ->expects($this->once())
            ->method('loadOneClient');

        $request = $this->createMock(Request::class);

        $jsonResponder = $this->createMock(JsonResponder::class);
        $jsonResponder
            ->expects($this->once())
            ->method('respond')
            ->willReturn(new JsonResponse);

        $classToTest = new ClientOneController($loader, $jsonResponder);
        $id = 5;
        
        $this->assertInstanceOf(Response::class, $classToTest->seeClient($id, $request));
    }
    
}