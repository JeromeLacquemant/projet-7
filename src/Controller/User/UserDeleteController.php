<?php

namespace App\Controller\User;

use App\Responder\JsonResponder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\User\Interfaces\UserDeleteInterface;

class UserDeleteController
{
    private $userDeleteInterface;

    public function __construct(
        UserDeleteInterface $userDeleteInterface,
        JsonResponder $jsonResponder) 
    {
        $this->userDeleteInterface = $userDeleteInterface;
        $this->jsonResponder = $jsonResponder;
    }

     /**
     * @Route("api/users/{id}", name="delete_user", methods={"DELETE"})
     */
    public function deleteOneUser($id, Request $request)
    {
        $userDeleted = $this->userDeleteInterface->deleteUser($id);
        $message = $userDeleted[0];
        $codeStatus = $userDeleted[1];

        return $this->jsonResponder->respond(['message' => $message], $request, ['groups' => 'user:read'], $codeStatus);
    }
}
