<?php

namespace App\Services\User;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Services\User\Interfaces\UserAllLoaderInterface;

class UserAllLoader implements UserAllLoaderInterface
{
    private $userRepository;

    public function __construct(
        UserRepository $userRepository) 
    {
        $this->userRepository = $userRepository;        
    }

    public function loadAllUsers(Request $request)
    {
        $page = $request->query->get('page');

        if(!isset($page)) {
            $page = 1;
        }

        $paginatedResult = $this->userRepository->getUsers($page);

        return $paginatedResult;
    }
}