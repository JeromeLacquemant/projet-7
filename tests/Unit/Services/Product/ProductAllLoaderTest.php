<?php

declare(strict_types=1);

namespace App\Tests\Unit\Services\Product;

use PHPUnit\Framework\TestCase;
use App\Output\Outputs\ProductOutput;
use App\Repository\ProductRepository;
use App\Services\Product\ProductAllLoader;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\InputBag;
use App\Output\OutputConstructors\ProductAllOutputConstruction;

class ProductAllLoaderTest extends TestCase
{
    public function testProductAllLoader()
    {
        $productOutput = new ProductOutput();

        $productRepository = $this->createMock(ProductRepository::class);
        $productRepository
            ->expects($this->once())
            ->method('getProducts')
            ->willReturn('');

        $request = $this->createMock(Request::class);
        $request->query = new InputBag;

        $productAllOutputConstruction = $this->createMock(ProductAllOutputConstruction::class);
        $productAllOutputConstruction
            ->expects($this->once())
            ->method('outputConstruction')
            ->willReturn($productOutput); 

        $classToTest = new ProductAllLoader($productRepository, $productAllOutputConstruction);

        $this->assertEquals($productOutput, $classToTest->loadAllProducts($request));
    }
}