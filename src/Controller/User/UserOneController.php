<?php

namespace App\Controller\User;

use App\Responder\JsonResponder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\User\Interfaces\UserOneLoaderInterface;

class UserOneController
{
    private $loader;

    public function __construct(
        UserOneLoaderInterface $loader,
        JsonResponder $jsonResponder) 
    {
        $this->loader = $loader;
        $this->jsonResponder = $jsonResponder;
    }

     /**
     * @Route("/api/users/{id}", name="see_one_user", methods={"GET"})
     */
    public function seeUser($id, Request $request)
    {
        $user = $this->loader->loadOneUser($id);
        $codeStatus = $user[1];

        return $this->jsonResponder->respond($user[0], $request, ['groups' => 'user:read'], $codeStatus);
    }
}
