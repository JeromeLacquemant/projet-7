<?php

declare(strict_types=1);

namespace App\Tests\Unit\Services\User;

use App\Entity\User;
use App\Entity\Client;
use PHPUnit\Framework\TestCase;
use App\Services\User\UserModify;
use App\Repository\UserRepository;
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

        $client = new Client();

        $user = new User();
            $user->setUsername("Daniel");
            $user->setPassword("password");
            $user->setEmail("mai@mail.com");
            $user->setClient($client);

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

        $classToTest = new UserModify($userRepository, $entityManager, $security, $validator);
        $id = 5;
        $expected = "L'utilisateur a été modifié avec succès";

        $this->assertEquals($expected, $classToTest->modifyUser($id, $request));
    }
}