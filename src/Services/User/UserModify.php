<?php

namespace App\Services\User;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use App\Services\User\Interfaces\UserModifyInterface;

class UserModify implements UserModifyInterface
{
    private $userRepository;
    private $entityManagerInterface;

    public function __construct(
        UserRepository $userRepository,
        EntityManagerInterface $entityManagerInterface,
        Security $security
        ) 
    {
        $this->userRepository = $userRepository;
        $this->entityManagerInterface = $entityManagerInterface;
        $this->security = $security;
    }

    public function modifyUser($id, Request $request)
    {
        $registeredUser = $this->userRepository->find($id);
        $client = $this->security->getUser(); 

        $data = json_decode($request->getContent(), true);
        //dd($request->getContent());

        $registeredUser
            ->setUsername($data["username"])
            ->setPassword($data["password"])
            ->setEmail($data["email"])
            ->setClient($client);

        $this->entityManagerInterface->persist($registeredUser);
        $this->entityManagerInterface->flush();

        return true;
    }
}