<?php

namespace App\Services\User;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use App\Services\User\Interfaces\UserAddInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserAdd implements UserAddInterface
{
    private $serializer;
    private $entityManager;

    public function __construct(
        SerializerInterface $serializer,
        EntityManagerInterface $entityManager,
        Security $security,
        ValidatorInterface $validator) 
    {
        $this->serializer = $serializer;
        $this->entityManager = $entityManager;
        $this->security = $security;
        $this->validator = $validator;
    }

    public function addUser(Request $request) {
        $data = $request->getContent();
        $client = $this->security->getUser(); 
        
        $user = $this->serializer->deserialize($data, 'App\Entity\User', 'json');
        $user->setClient($client);

        $errors = $this->validator->validate($user);

        if (count($errors) > 0) {
            $errorsString = (string) $errors;

            return new Response($errorsString);
        }

        $this->entityManager->persist($user);
        $this->entityManager->flush();
        
        return true;
    }
}