<?php

namespace App\Controller;

use App\Interfaces\UserAddInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserAddController
{
    private $userAddInterface;

    public function __construct(
        UserAddInterface $userAddInterface) 
    {
        $this->userAddInterface = $userAddInterface;
    }

     /**
     * @Route("/users/add-new-user", name="add_user", methods={"POST"})
     */
    public function addOneUser(Request $request)
    {
        $response = new Response($this->userAddInterface->addUser($request), 201);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
