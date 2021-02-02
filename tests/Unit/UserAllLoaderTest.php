<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\Services\UserAllLoader;
use PHPUnit\Framework\TestCase;

class UserAllLoaderTest extends TestCase
{
    private $serializer;
    private $userRepository;

    public function testUserAllLoader()
    {
        $serializer = $this
        ->getMockBuilder('Symfony\Component\Serializer\SerializerInterface')
        ->disableOriginalConstructor()
        ->getMock();

        $userRepository = $this
        ->getMockBuilder('App\Repository\UserRepository')
        ->disableOriginalConstructor()
        ->getMock();


        // $userData = 
        
        $classToTest = new UserAllLoader($userRepository, $serializer);

        $this->assertEquals($userData, $classToTest->loadAllUsers());
    }
}