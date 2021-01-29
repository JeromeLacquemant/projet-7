<?php

namespace App\Services;

use App\Interfaces\UserAllLoaderInterface;
use App\Repository\UserRepository;
use Symfony\Component\Serializer\SerializerInterface;

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