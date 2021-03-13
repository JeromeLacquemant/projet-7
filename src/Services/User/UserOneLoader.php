<?php

namespace App\Services\User;

use App\Security\Voter\UserVoter;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use App\Services\User\Interfaces\UserOneLoaderInterface;
use Symfony\Component\Config\Definition\Exception\Exception;

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
        $user = $this->userRepository->find($id);

        if($this->security->isGranted('view', $user)) {
            $response = $this->serializer->serialize(
                $user, 
                "json", 
                ['groups' => 'user:read']
            );
            return $response;
        } else {
            throw new Exception('Vous n\'êtes pas autorisé');
        }
    }
}