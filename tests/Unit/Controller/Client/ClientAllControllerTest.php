<?php

namespace App\Tests\Unit\Controller\Client;

use App\Controller\Client\ClientAllController;
use App\Services\Client\Interfaces\ClientAllLoaderInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
