<?php

namespace App\Controller\User;

use App\Responder\JsonResponder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\User\Interfaces\UserModifyInterface;

class UserModifyController
{
    private $userModifyInterface;

    public function __construct(
        UserModifyInterface $userModifyInterface,
        JsonResponder $jsonResponder) 
    {
        $this->userModifyInterface = $userModifyInterface;
        $this->jsonResponder = $jsonResponder;
    }

     /**
     * @Route("api/users/{id}", name="modify_user", methods={"PUT"})
     */
    public function modifyOneUser($id, Request $request)
    {
        $userModified = $this->userModifyInterface->modifyUser($id, $request);

        return $this->jsonResponder->respond(['message' => $userModified], $request, ['groups' => 'user:read'], 200);
    }
}
