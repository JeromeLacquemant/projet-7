<?php

namespace App\Services\User;

use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Serializer\SerializerInterface;
use App\Services\User\Interfaces\UserAllLoaderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserAllLoader implements UserAllLoaderInterface
{
    private $userRepository;
    private $serializer;

    public function __construct(
        UserRepository $userRepository,
        SerializerInterface $serializer,
        Security $security) 
    {
        $this->userRepository = $userRepository;
        $this->serializer = $serializer;
        $this->security = $security;
    }

    public function loadAllUsers()
    {
        $id = $this->security->getUser();

        $data = $this->userRepository->findBy(['client' => $id]);

        $response = $this->serializer->serialize($data, "json", [
            'circular_reference_handler' => function($object){
                return $object->getId();
            }
        ]);

        return $response;
    }
}