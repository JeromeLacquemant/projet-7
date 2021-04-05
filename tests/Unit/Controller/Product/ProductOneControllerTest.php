<?php

namespace App\Tests\Unit\Product;

use PHPUnit\Framework\TestCase;
use App\Responder\JsonResponder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Controller\Product\ProductOneController;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Services\Product\Interfaces\ProductOneLoaderInterface;

class ProductOneControllerTest extends TestCase
{
    public function testUserAllController() 
    {
        $loader = $this->createMock(ProductOneLoaderInterface::class);
        $loader
            ->expects($this->once())
            ->method('loadOneProduct');

        $request = $this->createMock(Request::class);

        $jsonResponder = $this->createMock(JsonResponder::class);
        $jsonResponder
            ->expects($this->once())
            ->method('respond')
            ->willReturn(new JsonResponse);

        $classToTest = new ProductOneController($loader, $jsonResponder);
        $id = 5;
        
        $this->assertInstanceOf(Response::class, $classToTest->seeProduct($id, $request));
    }
    
}