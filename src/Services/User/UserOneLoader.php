<?php

namespace App\Services\User;

use App\Security\Voter\UserVoter;
use App\Repository\UserRepository;
use App\Exception\ClientUnauthorized;
use App\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\Security;
use App\Exception\ClientUnauthorizedException;
use App\Exception\ClientUnauthorizedToSeeUser;
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

        if(is_null($user)) {
            throw new UserNotFoundException('L\'utilisateur n\'a pas été trouvé');
        }

        if($this->security->isGranted('view', $user)) {
            $response = $this->serializer->serialize(
                $user, 
                "json", 
                ['groups' => 'user:read']
            );
            return $response;
        } 
            throw new ClientUnauthorizedException('Vous n\'êtes pas autorisé à accéder à cet user');
    }
}