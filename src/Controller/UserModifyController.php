<?php

namespace App\Controller;

use App\Entity\User;
use App\Interfaces\UserModifyInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserModifyController
{
    private $userModifyInterface;

    public function __construct(UserModifyInterface $userModifyInterface) 
    {
        $this->userModifyInterface = $userModifyInterface;
    }

     /**
     * @Route("/users/modify/{id}", name="modify_user", methods={"PUT"})
     */
    public function modifyOneUser($id, Request $request)
    {
        $response = new Response($this->userModifyInterface->modifyUser($id, $request), 204);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
