<?php

namespace App\DataFixtures;

use App\Entity\Client;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ClientFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new Client();
        $user
            ->setUsername("Client n°1")
            ->setPassword(password_hash('12345', PASSWORD_BCRYPT))
            ->setEmail("client1@gmail.com");
        $manager->persist($user);

        $user = new Client();
        $user
            ->setUsername("Client n°2")
            ->setPassword(password_hash('34521', PASSWORD_BCRYPT))
            ->setEmail("client2@gmail.com");
        $manager->persist($user);

        $user = new Client();
        $user
            ->setUsername("Client n°3")
            ->setPassword(password_hash('54321', PASSWORD_BCRYPT))
            ->setEmail("client3@gmail.com");
        $manager->persist($user);

        $manager->flush();
    }
}
