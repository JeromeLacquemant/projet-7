<?php

namespace App\Services\User;

use App\Repository\UserRepository;
use App\Exception\UserNotFoundException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use App\Exception\ClientUnauthorizedException;
use Symfony\Component\Validator\ConstraintViolation;
use App\Services\User\Interfaces\UserModifyInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserModify implements UserModifyInterface
{
    private $userRepository;
    private $entityManagerInterface;

    public function __construct(
        UserRepository $userRepository,
        EntityManagerInterface $entityManagerInterface,
        Security $security,
        ValidatorInterface $validator
        ) 
    {
        $this->userRepository = $userRepository;
        $this->entityManagerInterface = $entityManagerInterface;
        $this->security = $security;
        $this->validator = $validator;
    }

    public function modifyUser($id, Request $request)
    {
        $registeredUser = $this->userRepository->find($id);

        if(is_null($registeredUser)) {
            throw new UserNotFoundException('user not found');
        }

        if($this->security->isGranted('edit', $registeredUser))
        {
            $data = json_decode($request->getContent(), true);

            $registeredUser
                ->setUsername($data["username"])
                ->setPassword($data["password"])
                ->setEmail($data["email"]);

            $violations = $this->validator->validate($registeredUser);

            if (count($violations) > 0) {
                foreach ($violations as $violation) {
                   if ($violation instanceof ConstraintViolation) {
                        $message = $violation->getMessage();
                        $messages[] = $message;
                    }
                }
                return [$messages, 400];
            }
    
            $this->entityManagerInterface->persist($registeredUser);
            $this->entityManagerInterface->flush();
    
            return ["L'utilisateur a été modifié avec succès", 200];
        } else {
            throw new ClientUnauthorizedException('Vous n\'êtes pas autorisé à modifier à cet user');
        }
    }
}