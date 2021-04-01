<?php

declare(strict_types=1);

namespace App\Tests\Unit\Services\User;

use App\Repository\UserRepository;
use App\Services\User\UserAllLoader;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\InputBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Serializer\SerializerInterface;

class UserAllLoaderTest extends TestCase
{
    public function testUserAllLoader()
    {
        $serializer = $this->createMock(SerializerInterface::class);
        $serializer
            ->expects($this->once())
            ->method('serialize')
            ->willReturn('{test}');

        $userRepository = $this->createMock(UserRepository::class);

        $security = $this->createMock(Security::class);

        $request = $this->createMock(Request::class);
        $request->query = new InputBag();

        $classToTest = new UserAllLoader($userRepository, $serializer);

        $this->assertIsString($classToTest->loadAllUsers($request));
    }
}
