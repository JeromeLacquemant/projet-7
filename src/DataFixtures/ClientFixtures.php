<?php

namespace App\DataFixtures;

use App\Entity\Client;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ClientFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $names = [
            'Orange',
            'Free',
            'SFR',
            'Bouygues'
        ];

        for ($i = 0; $i <sizeof($names); ++$i) {
            $client = new Client();
            $client
                ->setUsername("Client ".$i)
                ->setPassword(password_hash('12345', PASSWORD_BCRYPT))
                ->setEmail("client_".$i."@gmail.com");

            $manager->persist($client);
            $this->addReference('Client '.$i, $client);
        }

        $manager->flush();
    }
}
