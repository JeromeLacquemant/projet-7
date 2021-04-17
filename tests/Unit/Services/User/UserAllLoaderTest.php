<?php

declare(strict_types=1);

namespace App\Tests\Unit\Services\User;

use PHPUnit\Framework\TestCase;
use App\Hateos\LinksConstructor;
use App\Repository\UserRepository;
use App\Services\User\UserAllLoader;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\InputBag;

class UserAllLoaderTest extends TestCase
{
    public function testUserAllLoader()
    {
        $userRepository = $this->createMock(UserRepository::class);
        $userRepository
            ->expects($this->once())
            ->method('getUsers')
            ->willReturn(new Paginator(1));

        $request = $this->createMock(Request::class);
        $request->query = new InputBag;

        $linksConstructor = $this->createMock(LinksConstructor::class);

        $classToTest = new UserAllLoader($userRepository, $linksConstructor);

        $this->assertInstanceOf(Paginator::class, $classToTest->loadAllUsers($request));
    }
}