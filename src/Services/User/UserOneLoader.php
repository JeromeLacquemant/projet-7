<?php

namespace App\Services\User;

use App\Repository\UserRepository;
use App\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\Security;
use App\Exception\ClientUnauthorizedException;
use App\Services\User\Interfaces\UserOneLoaderInterface;

class UserOneLoader implements UserOneLoaderInterface
{
    private $userRepository;

    public function __construct(
        UserRepository $userRepository,
        Security $security) 
    {
        $this->userRepository = $userRepository;
        $this->security = $security;
    }

    public function loadOneUser($id)
    {      
        $user = $this->userRepository->find($id);

        if(is_null($user)) {
            throw new UserNotFoundException('L\'utilisateur n\'a pas été trouvé');
        }

        if($this->security->isGranted('view', $user)) {
            return [$user, 200];
        } 
            throw new ClientUnauthorizedException('Vous n\'êtes pas autorisé à accéder à cet user');
    }
}