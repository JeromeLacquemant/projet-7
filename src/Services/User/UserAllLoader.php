<?php

namespace App\Services\User;

use App\Repository\UserRepository;
use Symfony\Component\Serializer\SerializerInterface;
use App\Services\User\Interfaces\UserAllLoaderInterface;

class UserAllLoader implements UserAllLoaderInterface
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

    public function loadAllUsers(){
        $data = $this->userRepository->findAll();
 
        return $this->serializer->serialize($data, "json");
    }
}