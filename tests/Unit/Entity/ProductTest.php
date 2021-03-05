<?php

declare(strict_types=1);

namespace App\Tests\Unit\Entity;

use App\Entity\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testSetName()
    {
        $classToTest = new Product();

        $classToTest->setName("Produit1");
        $this->assertEquals('Produit1', $classToTest->getName());
    }

    public function testSetDescription()
    {
        $classToTest = new Product();

        $classToTest->setDescription("Description du produit");
        $this->assertEquals('Description du produit', $classToTest->getDescription());
    }

    public function testSetPrice()
    {
        $classToTest = new Product();

        $classToTest->setPrice("265");
        $this->assertEquals('265', $classToTest->getPrice());
    }
}