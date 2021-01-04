<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user
            ->setUsername("Username n°1")
            ->setPassword('12345')
            ->setEmail("username1@gmail.com");
        $manager->persist($user);

        $user = new User();
        $user
            ->setUsername("Username n°2")
            ->setPassword('34521')
            ->setEmail("username2@gmail.com");
        $manager->persist($user);

        $user = new User();
        $user
            ->setUsername("Username n°3")
            ->setPassword('54321')
            ->setEmail("username3@gmail.com");
        $manager->persist($user);

        $manager->flush();
    }
}
