<?php

declare(strict_types=1);

namespace App\Tests\Unit\Services\User;

use App\Entity\User;
use App\Entity\Client;
use PHPUnit\Framework\TestCase;
use App\Hateos\LinksConstructor;
use App\Repository\UserRepository;
use App\Services\User\UserOneLoader;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Serializer\SerializerInterface;

class UserOneLoaderTest extends TestCase
{
    public function testUserOneLoader()
    {
        $client = new Client();

        $user = new User();
            $user->setUsername("Daniel");
            $user->setPassword("password");
            $user->setEmail("mai@ail.com");
            $user->setClient($client);

        $userRepository = $this->createMock(UserRepository::class);
            $userRepository
                ->expects($this->once())
                ->method('find')
                ->willReturn($user);   

        $security = $this->createMock(Security::class);
        $security
            ->expects($this->once())
            ->method('isGranted')
            ->willReturn(true);

        $request = $this->createMock(Request::class);

        $linksConstructor = $this->createMock(LinksConstructor::class);

        $classToTest = new UserOneLoader($userRepository, $security, $linksConstructor);
        $expected = [$user, 200];
        $id = 8;

        $this->assertEquals($expected, $classToTest->loadOneUser($id, $request));
    }
}