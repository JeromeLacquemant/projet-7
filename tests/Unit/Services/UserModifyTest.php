<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\Entity\User;
use App\Services\UserModify;
use PHPUnit\Framework\TestCase;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

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

        //$user = new User();
        //    $user->setUsername("Daniel");
        //    $user->setPassword("password");
        //    $user->setEmail("mail@mail.com");

        $userRepository = $this->createMock(UserRepository::class);
        $userRepository
            ->expects($this->once())
            ->method('find');    
        
        $request = $this->createMock(Request::class);
        $request    
            ->expects($this->once())
            ->method('getContent')
            ->willReturn('{"username":"daniel","password":"password","mail":"mail@mail.com"}');

        $classToTest = new UserModify($userRepository, $entityManager);
        $id = 5;

        $this->assertTrue($classToTest->modifyUser($id, $request));
    }
}