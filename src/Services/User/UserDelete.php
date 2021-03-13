<?php

namespace App\Services\User;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;
use App\Services\User\Interfaces\UserDeleteInterface;
use Symfony\Component\HttpFoundation\Response;

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

        if($this->security->isGranted('edit', $user)) {
            $this->entityManagerInterface->remove($user);
            $this->entityManagerInterface->flush();
    
            return true;
        }
    }
}