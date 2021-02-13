<?php

namespace App\Services\User;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Services\User\Interfaces\UserDeleteInterface;

class UserDelete implements UserDeleteInterface
{
    private $userRepository;
    private $entityManagerInterface;

    public function __construct(
        UserRepository $userRepository,
        EntityManagerInterface $entityManagerInterface) 
    {
        $this->userRepository = $userRepository;
        $this->entityManagerInterface = $entityManagerInterface;
    }

    public function deleteUser($id)
    {
        $user = $this->userRepository->find($id);

        $this->entityManagerInterface->remove($user);
        $this->entityManagerInterface->flush();

        return true;
    }
}