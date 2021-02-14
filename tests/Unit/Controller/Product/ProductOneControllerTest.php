<?php

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use App\Controller\Product\ProductOneController;
use App\Services\Product\Interfaces\ProductOneLoaderInterface;

class ProductOneControllerTest extends TestCase
{
    public function testUserAllController() 
    {
        $loader = $this->createMock(ProductOneLoaderInterface::class);
        $loader
            ->expects($this->once())
            ->method('loadOneProduct');

        $classToTest = new ProductOneController($loader);
        $id = 5;
        
        $this->assertInstanceOf(Response::class, $classToTest->seeProduct($id));
    }
    
}