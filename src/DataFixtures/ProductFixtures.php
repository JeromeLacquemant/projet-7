<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $product = new Product();
        $product
            ->setName("Téléphone 1")
            ->setDescription("Description du téléphone 1")
            ->setPrice("600");
        $manager->persist($product);

        $product = new Product();
        $product
            ->setName("Téléphone 2")
            ->setDescription("Description du téléphone 2")
            ->setPrice("500");
        $manager->persist($product);

        $product = new Product();
        $product
            ->setName("Téléphone 3")
            ->setDescription("Description du téléphone 3")
            ->setPrice("300");
        $manager->persist($product);
        
        $manager->flush();
    }
}
