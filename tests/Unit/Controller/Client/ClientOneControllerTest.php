<?php

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use App\Controller\Client\ClientOneController;
use App\Services\Client\Interfaces\ClientOneLoaderInterface;

class ClientOneControllerTest extends TestCase
{
    public function testClientOneController() 
    {
        $loader = $this->createMock(ClientOneLoaderInterface::class);
        $loader
            ->expects($this->once())
            ->method('loadOneClient');

        $classToTest = new ClientOneController($loader);
        $id = 5;
        
        $this->assertInstanceOf(Response::class, $classToTest->seeClient($id));
    }
    
}