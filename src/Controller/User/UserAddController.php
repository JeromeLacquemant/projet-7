<?php

namespace App\Controller\User;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\User\Interfaces\UserAddInterface;

class UserAddController
{
    private $userAddInterface;

    public function __construct(
        UserAddInterface $userAddInterface) 
    {
        $this->userAddInterface = $userAddInterface;
    }

     /**
     * @Route("api/users/add-new-user", name="add_user", methods={"POST"})
     */
    public function addOneUser(Request $request)
    {
        $response = new Response($this->userAddInterface->addUser($request), 201);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
