<?php

namespace App\Services\User;

use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use App\Services\User\Interfaces\UserOneLoaderInterface;

class UserOneLoader implements UserOneLoaderInterface
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

    public function loadOneUser($id)
    {
        $client = $this->security->getUser();
        
        $user = $this->userRepository->find($id);

        if($user->getClient() === $client)
        {
            $response = $this->serializer->serialize(
                $user, 
                "json", 
                ['groups' => 'user:read']
            );
    
            return $response;

        } else {
            return new Response("Vous n'êtes pas autorisé !");
        };
    }
}