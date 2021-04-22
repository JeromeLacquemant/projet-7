<?php

declare(strict_types=1);

namespace App\Tests\Unit\Services\User;

use App\Entity\User;
use App\Dto\UserResponseDto;
use PHPUnit\Framework\TestCase;
use App\Services\User\UserModify;
use App\Repository\UserRepository;
use App\Dto\CustomerUserResponseDto;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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

        $userResponseDto = new UserResponseDto();
            $userResponseDto->username = "username";
            $userResponseDto->email = 'mail@mail.com';
            $userResponseDto->password = "password";

        $customerUserResponseDto = $this->createMock(CustomerUserResponseDto::class);
        $customerUserResponseDto
            ->expects($this->once())
            ->method('transformFromObject')
            ->willReturn($userResponseDto);

        $user = new User();
        $user  
            ->setUsername("username")
            ->setPassword("password")
            ->setEmail("mai@mail.com");

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
        $request    
            ->expects($this->once())
            ->method('getContent')
            ->willReturn('{"username":"daniel","password":"password","email":"mail@mail.com"}');

        $security = $this->createMock(Security::class);
        $security
            ->expects($this->once())
            ->method('isGranted')
            ->willReturn(true);

        $classToTest = new UserModify($userRepository, $entityManager, $security, $validator, $customerUserResponseDto);
        $id = 1;
        $expected = ["L'utilisateur a été modifié avec succès", 200];

        $this->assertEquals($expected, $classToTest->modifyUser($id, $request));
    }
}