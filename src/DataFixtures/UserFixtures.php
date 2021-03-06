<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    public const NUMBER = 100;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= self::NUMBER; ++$i) {
            $user = new User('Lastname '.$i, 'firstname '.$i);
            $user 
                ->setUsername('Username '.$i)
                ->setPassword(password_hash('12345', PASSWORD_BCRYPT))
                ->setEmail("user_".$i."@gmail.com")
                ->setClient($this->getReference('Client '.mt_rand(0, 3)));

            $manager->persist($user);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ClientFixtures::class,
        ];
    }
}
