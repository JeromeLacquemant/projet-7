<?php

namespace App\Services\User;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use App\Services\User\Interfaces\UserAddInterface;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Serializer\SerializerInterface;
use App\Output\OutputConstructors\UserAddOutputConstruction;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserAdd implements UserAddInterface
{
    private $serializer;
    private $entityManager;
    private $security;
    private $validator;
    private $userAddOutputConstruction;

    public function __construct(
        SerializerInterface $serializer,
        EntityManagerInterface $entityManager,
        Security $security,
        ValidatorInterface $validator,
        UserAddOutputConstruction $userAddOutputConstruction) 
    {
        $this->serializer = $serializer;
        $this->entityManager = $entityManager;
        $this->security = $security;
        $this->validator = $validator;
        $this->userAddOutputConstruction = $userAddOutputConstruction;
    }

    public function addUser(Request $request) {
        
        $outputUser = $this->userAddOutputConstruction->outputConstruction($request);

        if(is_array($outputUser))
        {
            return [$outputUser, 400];
        }

        $data = $request->getContent();
        $client = $this->security->getUser(); 
        
        $user = $this->serializer->deserialize($data, 'App\Entity\User', 'json');
        $user->setClient($client);

        $violations = $this->validator->validate($user);

        if (count($violations) > 0) {
            foreach ($violations as $violation) {
                if ($violation instanceof ConstraintViolation) {
                    $message = $violation->getMessage();
                    $messages[] = $message;
                }
            }
            return [$messages, 400];
        }

        $this->entityManager->persist($user);
        $this->entityManager->flush();
        
        return ["L'utilisateur a été ajouté avec succès", 201];
    }
}