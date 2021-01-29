<?php

namespace App\Services;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Interfaces\UserModifyInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

class UserModify implements UserModifyInterface
{
    private $userRepository;
    private $entityManagerInterface;
    private $serializer;


    public function __construct(
        UserRepository $userRepository,
        EntityManagerInterface $entityManagerInterface,
        SerializerInterface $serializer,
        ) 
    {
        $this->userRepository = $userRepository;
        $this->entityManagerInterface = $entityManagerInterface;
        $this->serializer = $serializer;
    }

    public function modifyUser($id, Request $request)
    {
        $registeredUser = $this->userRepository->find($id);

        $data = json_decode($request->getContent(), true);

        $registeredUser
            ->setUsername($data["username"])
            ->setPassword($data["password"])
            ->setEmail($data["email"]);

        $this->entityManagerInterface->persist($registeredUser);
        return $this->entityManagerInterface->flush();
    }
}