<?php

namespace App\Services\User;

use App\Repository\UserRepository;
use App\Services\User\Interfaces\UserAllLoaderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

class UserAllLoader implements UserAllLoaderInterface
{
    private $userRepository;
    private $serializer;

    public function __construct(
        UserRepository $userRepository,
        SerializerInterface $serializer)
    {
        $this->userRepository = $userRepository;
        $this->serializer = $serializer;
    }

    public function loadAllUsers(Request $request)
    {
        $page = $request->query->get('page');

        if (isset($page)) {
            $page = 1;
        }

        $paginatedResult = $this->userRepository->getUsers($page);

        $response = $this->serializer->serialize(
            $paginatedResult,
            'json',
            ['groups' => 'user:read']
        );

        return $response;
    }
}
