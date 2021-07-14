<?php

declare(strict_types=1);

namespace App\Tests\Unit\Services\User;

use App\Entity\User;
use PHPUnit\Framework\TestCase;
use App\Services\User\UserModify;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Output\OutputConstructors\UserValidationOutputConstruction;

class UserModifyTest extends TestCase
{
    public function testUserModify()
    {
        $entityManager = $this->createMock(EntityManagerInterface::class);
        $entityManager
            ->expects($this->once())
            ->method('persist');
        $entityManager
            ->expects($this->once())
            ->method('flush');

        $user = new User("username", "password", "email");

        $userRepository = $this->createMock(UserRepository::class);
        $userRepository
            ->expects($this->once())
            ->method('find')
            ->willReturn($user); 

        $validator = $this->createMock(ValidatorInterface::class);
        $validator
            ->expects($this->once())
            ->method('validate')
            ->willReturn([]);

        $request = $this->createMock(Request::class);

        $security = $this->createMock(Security::class);
        $security
            ->expects($this->once())
            ->method('isGranted')
            ->willReturn(true);

        $userValidationOutputConstruction = $this->createMock(UserValidationOutputConstruction::class);
        $userValidationOutputConstruction
            ->expects($this->once())
            ->method('outputConstruction')
            ->willReturn($user); 

        $classToTest = new UserModify($userRepository, $entityManager, $security, $validator, $userValidationOutputConstruction);
        $id = 5;
        $expected = ["L'utilisateur a été modifié avec succès", 200];

        $this->assertEquals($expected, $classToTest->modifyUser($id, $request));
    }
}