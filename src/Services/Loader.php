<?php

namespace App\Services;

use App\Services\LoaderInterface;
use App\Repository\UserRepository;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;

class Loader implements LoaderInterface
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

    public function load(){
        $data = $this->userRepository->findAll();
 
        return $this->serializer->serialize($data, "json");
    }
}