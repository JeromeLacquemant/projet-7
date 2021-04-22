<?php

declare(strict_types=1);

namespace App\Tests\Unit\Services\Product;

use App\Entity\Product;
use PHPUnit\Framework\TestCase;
use App\Output\Outputs\ProductOutput;
use App\Repository\ProductRepository;
use App\Services\Product\ProductOneLoader;
use Symfony\Component\HttpFoundation\Request;
use App\Output\OutputConstructors\ProductOneOutputConstruction;

class ProductOneLoaderTest extends TestCase
{
    public function testUserOneLoader()
    {
        $product = new Product();
        $productOutput = new ProductOutput();

        $productRepository = $this->createMock(ProductRepository::class);
        $productRepository
            ->expects($this->once())
            ->method('find')
            ->willReturn($product);   

        $request = $this->createMock(Request::class);

        $productOneOutputConstruction = $this->createMock(ProductOneOutputConstruction::class);
        $productOneOutputConstruction
            ->expects($this->once())
            ->method('outputConstruction')
            ->willReturn($productOutput); 

        $classToTest = new ProductOneLoader($productRepository, $productOneOutputConstruction);

        $id = 8;
        
        $this->assertInstanceOf(ProductOutput::class, $classToTest->loadOneProduct($id, $request));
    }
}