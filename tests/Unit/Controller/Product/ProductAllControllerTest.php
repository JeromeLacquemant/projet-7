<?php

namespace App\Tests\Unit\Controller\Product;

use App\Controller\Product\ProductAllController;
use App\Services\Product\Interfaces\ProductAllLoaderInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
