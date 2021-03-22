<?php

declare(strict_types=1);

namespace App\Tests\Unit\Services\Product;

use App\Entity\Client;
use App\Entity\Product;
use PHPUnit\Framework\TestCase;
use App\Repository\UserRepository;
use App\Services\User\UserOneLoader;
use App\Repository\ProductRepository;
use App\Services\Product\ProductOneLoader;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Serializer\SerializerInterface;

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

        $serializer = $this->createMock(SerializerInterface::class);
        $serializer
            ->expects($this->once())
            ->method('serialize')
            ->willReturn('{test}');

        $classToTest = new ProductOneLoader($productRepository, $serializer);

        $id = 8;

        $this->assertIsString($classToTest->loadOneProduct($id));
    }
}