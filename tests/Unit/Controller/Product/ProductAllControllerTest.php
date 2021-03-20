<?php

namespace App\Tests\Unit\Product;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Controller\Product\ProductAllController;
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

        $classToTest = new ProductAllController($loader);

        $this->assertInstanceOf(Response::class, $classToTest->seeProducts($request));
    }
    
}