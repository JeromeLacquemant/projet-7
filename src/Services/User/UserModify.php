<?php

namespace App\Services\User;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Services\User\Interfaces\UserModifyInterface;

class UserModify implements UserModifyInterface
{
    private $userRepository;
    private $entityManagerInterface;

    public function __construct(
        UserRepository $userRepository,
        EntityManagerInterface $entityManagerInterface
        ) 
    {
        $this->userRepository = $userRepository;
        $this->entityManagerInterface = $entityManagerInterface;
    }

    public function modifyUser($id, Request $request)
    {
        $registeredUser = $this->userRepository->find($id);
        
        $data = json_decode($request->getContent(), true);
        //dd($request->getContent());

        $registeredUser
            ->setUsername($data["username"])
            ->setPassword($data["password"])
            ->setEmail($data["email"]);

        $this->entityManagerInterface->persist($registeredUser);
        $this->entityManagerInterface->flush();

        return true;
    }
}