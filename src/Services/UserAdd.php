<?php

namespace App\Services;

use App\Interfaces\UserAddInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

class UserAdd implements UserAddInterface
{
    private $serializer;
    private $entityManager;

    public function __construct(
        SerializerInterface $serializer,
        EntityManagerInterface $entityManager) 
    {
        $this->serializer = $serializer;
        $this->entityManager = $entityManager;
    }

    public function addUser(Request $request) {
        $data = $request->getContent();
        
        $user = $this->serializer->deserialize($data, 'App\Entity\User', 'json');

        $this->entityManager->persist($user);
        return $this->entityManager->flush();
    }
}