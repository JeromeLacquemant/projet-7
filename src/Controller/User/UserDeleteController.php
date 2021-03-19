<?php

namespace App\Controller\User;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Services\User\Interfaces\UserDeleteInterface;

class UserDeleteController
{
    private $userDeleteInterface;

    public function __construct(UserDeleteInterface $userDeleteInterface) 
    {
        $this->userDeleteInterface = $userDeleteInterface;
    }

     /**
     * @Route("api/users/delete/{id}", name="delete_user", methods={"DELETE"})
     */
    public function deleteOneUser($id)
    {
        $response = new JsonResponse(['message' => $this->userDeleteInterface->deleteUser($id)], 200);

        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
