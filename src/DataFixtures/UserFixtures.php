<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    public const NUMBER = 100;

    // public function __construct(UserPasswordEncoderInterface $encoder)
    // {
    //     $this->encoder = $encoder;
    // }

    public function load(ObjectManager $manager)
    {
        $user = new User('Lastname 1', 'firstname 1', "user_1@gmail.com");
        $user 
            ->setUsername('Username dd')
            ->setPassword(password_hash('12345', PASSWORD_BCRYPT))
            ->setEmail("user_1@gmail.com")
            ->setClient($this->getReference('Client 1'));
        $manager->persist($user);

        $user = new User('Lastname 2', 'firstname 2', "user_2@gmail.com");
        $user 
            ->setUsername('Username 2')
            ->setPassword(password_hash('12345', PASSWORD_BCRYPT))
            ->setEmail("user_2@gmail.com")
            ->setClient($this->getReference('Client 2'));
        $manager->persist($user);

        for ($i = 3; $i <= self::NUMBER; ++$i) {
            $user = new User('Lastname '.$i, 'firstname '.$i, "user_".$i."@gmail.com");
            $user 
                ->setUsername('Usernamesss '.$i)
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
