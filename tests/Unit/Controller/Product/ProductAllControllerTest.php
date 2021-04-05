<?php

namespace App\Tests\Unit\Product;

use PHPUnit\Framework\TestCase;
use App\Responder\JsonResponder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Controller\Product\ProductAllController;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Services\Product\Interfaces\ProductAllLoaderInterface;

class ProductAllControllerTest extends TestCase
{
    public function testProductAllController() 
    {
        $loader = $this->createMock(ProductAllLoaderInterface::class);
        $loader
            ->expects($this->once())
            ->method('loadAllProducts');

        $request = $this->createMock(Request::class);
        $jsonResponder = $this->createMock(JsonResponder::class);
        $jsonResponder
            ->expects($this->once())
            ->method('respond')
            ->willReturn(new JsonResponse);

        $classToTest = new ProductAllController($loader, $jsonResponder);

        $this->assertInstanceOf(JsonResponse::class, $classToTest->seeProducts($request));
    }
    
}