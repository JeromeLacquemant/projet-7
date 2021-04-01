<?php

namespace App\Services\User;

use App\Services\User\Interfaces\UserAddInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\ConstraintViolation;
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

    public function addUser(Request $request)
    {
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

            return $messages;
        }

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return "L'utilisateur a été ajouté avec succès";
    }
}
