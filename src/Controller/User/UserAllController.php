<?php

namespace App\Controller\User;

use App\Responder\JsonResponder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\User\Interfaces\UserAllLoaderInterface;

class UserAllController
{
    private $loader;

    public function __construct(
        UserAllLoaderInterface $loader,
        JsonResponder $jsonResponder) 
    {
        $this->loader = $loader;
        $this->jsonResponder = $jsonResponder;
    }

     /**
     * @Route("/api/users", name="see_all_users", methods={"GET"})
     */
    public function seeUsers(Request $request)
    {
        $users = $this->loader->loadAllUsers($request);

        return $this->jsonResponder->respond($users, $request, 200);
    }
}
