<?php

declare(strict_types=1);

namespace App\Tests\Unit\Services\Product;

use App\Repository\ProductRepository;
use App\Services\Product\ProductAllLoader;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\InputBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

class ProductAllLoaderTest extends TestCase
{
    public function testProductAllLoader()
    {
        $serializer = $this->createMock(SerializerInterface::class);
        $serializer
            ->expects($this->once())
            ->method('serialize')
            ->willReturn('{test}');

        $productRepository = $this->createMock(ProductRepository::class);

        $request = $this->createMock(Request::class);
        $request->query = new InputBag();

        $classToTest = new ProductAllLoader($productRepository, $serializer);

        $this->assertIsString($classToTest->loadAllProducts($request));
    }
}
