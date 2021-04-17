<?php

namespace App\Services\User;

use App\Hateos\LinksConstructor;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Services\User\Interfaces\UserAllLoaderInterface;

class UserAllLoader implements UserAllLoaderInterface
{
    private $userRepository;

    public function __construct(
        UserRepository $userRepository,
        LinksConstructor $linksConstructor) 
    {
        $this->userRepository = $userRepository;   
        $this->linksConstructor = $linksConstructor;     
    }

    public function loadAllUsers(Request $request)
    {
        $page = $request->query->get('page');

        if(!isset($page)) {
            $page = 1;
        }

        $paginatedResult = $this->userRepository->getUsers($page);

        $this->linksConstructor->linksConstruction($paginatedResult, $request);

        return $paginatedResult;
    }
}