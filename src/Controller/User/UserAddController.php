<?php

namespace App\Controller\User;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\User\Interfaces\UserAddInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

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
        $data = $this->userAddInterface->addUser($request);

        $response = new JsonResponse(['message' => $data], 201);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
