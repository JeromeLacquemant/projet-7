<?php

declare(strict_types=1);

namespace App\Tests\Unit\Services\Product;

use App\Entity\Product;
use PHPUnit\Framework\TestCase;
use App\Hateos\LinksConstructor;
use App\Repository\ProductRepository;
use App\Services\Product\ProductOneLoader;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\HttpFoundation\Request;

class ProductOneLoaderTest extends TestCase
{
    public function testUserOneLoader()
    {
        $product = new Product();

        $productRepository = $this->createMock(ProductRepository::class);
        $productRepository
            ->expects($this->once())
            ->method('find')
            ->willReturn($product);   

        $request = $this->createMock(Request::class);

        $linksConstructor = $this->createMock(LinksConstructor::class);

        $classToTest = new ProductOneLoader($productRepository, $linksConstructor);

        $id = 8;
        
        $this->assertInstanceOf(Product::class, $classToTest->loadOneProduct($id, $request));
    }
}