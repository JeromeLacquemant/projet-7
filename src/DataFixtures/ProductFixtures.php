<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProductFixtures extends Fixture
{
    public const NUMBER = 100;

    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i<self::NUMBER; ++$i)
        {
            $product = new Product();
            $product
                ->setName("Téléphone ".$i)
                ->setDescription("Description du téléphone ".$i)
                ->setPrice(rand(400, 850));
            $manager->persist($product);   
        }
        
        $manager->flush();
    }
}
