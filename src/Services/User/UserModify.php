<?php

namespace App\Services\User;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use App\Services\User\Interfaces\UserModifyInterface;
use Symfony\Component\Config\Definition\Exception\Exception;

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

        if($this->security->isGranted('view', $registeredUser))
        {
            $data = json_decode($request->getContent(), true);

            $registeredUser
                ->setUsername($data["username"])
                ->setPassword($data["password"])
                ->setEmail($data["email"]);
    
            $this->entityManagerInterface->persist($registeredUser);
            $this->entityManagerInterface->flush();
    
            return true;
        } else {
            throw new Exception('Vous n\'êtes pas autorisé');
        }
    }
}