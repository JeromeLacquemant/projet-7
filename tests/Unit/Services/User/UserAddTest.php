<?php

declare(strict_types=1);

namespace App\Tests\Unit\Services\User;

use App\Entity\User;
use App\Entity\Client;
use App\Services\User\UserAdd;
use PHPUnit\Framework\TestCase;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Output\OutputConstructors\UserValidationOutputConstruction;

class UserAddTest extends TestCase
{
    public function testUserAdd()
    {
        $client = new Client();

        $user = new User("username", "password", "email");

        $entityManager = $this->createMock(EntityManagerInterface::class);
        $entityManager
            ->expects($this->once())
            ->method('persist');
        $entityManager
            ->expects($this->once())
            ->method('flush');

        $validator = $this->createMock(ValidatorInterface::class);
        $validator
            ->expects($this->once())
            ->method('validate')
            ->willReturn([]);

        $request = $this->createMock(Request::class);

        $security = $this->createMock(Security::class);
        $security
            ->expects($this->once())
            ->method('getUser')
            ->willReturn($client);

        $userValidationOutputConstruction = $this->createMock(UserValidationOutputConstruction::class);
        $userValidationOutputConstruction
            ->expects($this->once())
            ->method('outputConstruction')
            ->willReturn($user); 

        $classToTest = new UserAdd($entityManager, $security, $validator, $userValidationOutputConstruction);
        $expected = ["L'utilisateur a été ajouté avec succès", 201];

        $this->assertEquals($expected, $classToTest->addUser($request));
    }
}