<?php

namespace App\Services\User;

use App\Repository\UserRepository;
use App\Exception\ClientUnauthorized;
use App\Exception\UserNotFoundException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;
use App\Exception\ClientUnauthorizedException;
use App\Exception\ClientUnauthorizedToSeeUser;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Services\User\Interfaces\UserDeleteInterface;
use Symfony\Component\Config\Definition\Exception\Exception;

class UserDelete implements UserDeleteInterface
{
    private $userRepository;
    private $entityManagerInterface;

    public function __construct(
        UserRepository $userRepository,
        EntityManagerInterface $entityManagerInterface,
        Security $security) 
    {
        $this->userRepository = $userRepository;
        $this->entityManagerInterface = $entityManagerInterface;
        $this->security = $security;
    }

    public function deleteUser($id)
    {
        $user = $this->userRepository->find($id);

        if(is_null($user)) {
            throw new UserNotFoundException('Cet utilisateur n\'existe pas');
        }

        if($this->security->isGranted('delete', $user)) {
            $this->entityManagerInterface->remove($user);
            $this->entityManagerInterface->flush();
    
            return "L'utilisateur a bien été effacé de la base de données";
        } else {
            throw new ClientUnauthorizedException('Vous n\'êtes pas autorisé à effacer à cet user');
        }
    }
}