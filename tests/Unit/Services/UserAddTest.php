<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\Services\UserAdd;
use PHPUnit\Framework\TestCase;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

class UserAddTest extends TestCase
{
    public function testUserAdd()
    {
        $serializer = $this->createMock(SerializerInterface::class);
        $serializer
            ->expects($this->once())
            ->method('deserialize')
            ->willReturn('App\Entity\User');

        $entityManager = $this->createMock(EntityManagerInterface::class);
        $entityManager
            ->expects($this->once())
            ->method('persist');
        $entityManager
            ->expects($this->once())
            ->method('flush');

        $request = $this->createMock(Request::class);

        $classToTest = new UserAdd($serializer, $entityManager);

        $this->assertTrue($classToTest->addUser($request));
    }
}