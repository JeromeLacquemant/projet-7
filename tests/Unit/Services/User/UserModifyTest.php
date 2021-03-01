<?php

declare(strict_types=1);

namespace App\Tests\Unit\Services\User;

use App\Entity\Client;
use App\Entity\User;
use PHPUnit\Framework\TestCase;
use App\Services\User\UserModify;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

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

        $security = $this->createMock(Security::class);
        $security    
            ->expects($this->once())
            ->method('getClient')
            ->willReturn(Client::class);

        $classToTest = new UserModify($userRepository, $entityManager, $security);
        $id = 5;

        $this->assertTrue($classToTest->modifyUser($id, $request));
    }
}