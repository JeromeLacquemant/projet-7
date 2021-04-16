<?php

namespace App\Services\User;

use App\Repository\UserRepository;
use App\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\Security;
use App\Exception\ClientUnauthorizedException;
use App\Hateos\LinksConstructor;
use App\Services\User\Interfaces\UserOneLoaderInterface;

class UserOneLoader implements UserOneLoaderInterface
{
    private $userRepository;

    public function __construct(
        UserRepository $userRepository,
        Security $security,
        LinksConstructor $linksConstructor) 
    {
        $this->userRepository = $userRepository;
        $this->security = $security;
        $this->linksConstructor = $linksConstructor;
    }

    public function loadOneUser($id, $request)
    {      
        $user = $this->userRepository->find($id);

        if(is_null($user)) {
            throw new UserNotFoundException('L\'utilisateur n\'a pas été trouvé');
        }

        $this->linksConstructor->linksConstruction($user, $request, $id);

        if($this->security->isGranted('view', $user)) {
            return [$user, 200];
        } 
            throw new ClientUnauthorizedException('Vous n\'êtes pas autorisé à accéder à cet user');
    }
}