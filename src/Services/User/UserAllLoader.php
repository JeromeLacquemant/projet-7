<?php

namespace App\Services\User;

use App\Hateos\LinksConstructor;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Services\User\Interfaces\UserAllLoaderInterface;
use App\Output\OutputConstructors\UserAllOutputConstruction;

class UserAllLoader implements UserAllLoaderInterface
{
    private $userRepository;

    public function __construct(
        UserRepository $userRepository,
        UserAllOutputConstruction $userAllOutputConstruction) 
    {
        $this->userRepository = $userRepository;   
        $this->userAllOutputConstruction = $userAllOutputConstruction;     
    }

    public function loadAllUsers(Request $request)
    {
        $page = $request->query->get('page');

        if(!isset($page)) {
            $page = 1;
        }

        $paginatedResult = $this->userRepository->getUsers($page);

        $outputUser = $this->userAllOutputConstruction->outputConstruction($paginatedResult, $request);

        return $outputUser;
    }
}