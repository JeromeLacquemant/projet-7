<?php

namespace App\Tests\Unit\Product;

use PHPUnit\Framework\TestCase;
use App\Controller\Product\ProductAllController;
use Symfony\Component\HttpFoundation\Response;
use App\Services\Product\Interfaces\ProductAllLoaderInterface;

class ProductAllControllerTest extends TestCase
{
    public function testProductAllController() 
    {
        $loader = $this->createMock(ProductAllLoaderInterface::class);
        $loader
            ->expects($this->once())
            ->method('loadAllProducts');

        $classToTest = new ProductAllController($loader);

        $this->assertInstanceOf(Response::class, $classToTest->seeProducts());
    }
    
}