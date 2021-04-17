<?php

declare(strict_types=1);

namespace App\Tests\Unit\Services\Product;

use PHPUnit\Framework\TestCase;
use App\Hateos\LinksConstructor;
use App\Repository\ProductRepository;
use App\Services\Product\ProductAllLoader;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\InputBag;
use Symfony\Component\Serializer\SerializerInterface;

class ProductAllLoaderTest extends TestCase
{
    public function testProductAllLoader()
    {
        $productRepository = $this->createMock(ProductRepository::class);
        $productRepository
            ->expects($this->once())
            ->method('getProducts')
            ->willReturn(new Paginator(1));

        $request = $this->createMock(Request::class);
        $request->query = new InputBag;

        $linksConstructor = $this->createMock(LinksConstructor::class);

        $classToTest = new ProductAllLoader($productRepository, $linksConstructor);

        $this->assertInstanceOf(Paginator::class, $classToTest->loadAllProducts($request));
    }
}