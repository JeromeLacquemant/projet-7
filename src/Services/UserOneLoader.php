<?php

namespace App\Services;

use App\Interfaces\UserOneLoaderInterface;
use App\Repository\UserRepository;
use Symfony\Component\Serializer\SerializerInterface;

class UserOneLoader implements UserOneLoaderInterface
{
    private $userRepository;
    private $serializer;

    public function __construct(
        UserRepository $userRepository,
        SerializerInterface $serializer) 
    {
        $this->userRepository = $userRepository;
        $this->serializer = $serializer;
    }

    public function loadOneUser($id){

        $user = $this->userRepository->find($id);
    
        return $this->serializer->serialize($user, "json");
    }
}