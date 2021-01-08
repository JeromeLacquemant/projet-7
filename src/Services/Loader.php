<?php

namespace App\Services;

use App\Services\LoaderInterface;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class Loader implements LoaderInterface
{
    private $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function log(){
        return $this->userRepository->findAll();
    }
}