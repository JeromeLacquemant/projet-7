<?php

namespace App\Controller\User;

use App\Responder\JsonResponder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\User\Interfaces\UserAddInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserAddController
{
    private $userAddInterface;

    public function __construct(
        UserAddInterface $userAddInterface,
        JsonResponder $jsonResponder) 
    {
        $this->userAddInterface = $userAddInterface;
        $this->jsonResponder = $jsonResponder;
    }

     /**
     * @Route("/api/users", name="add_user", methods={"POST"})
     */
    public function addOneUser(Request $request)
    {
        $userAdded = $this->userAddInterface->addUser($request);
        $message = $userAdded[0];
        $codeStatus = $userAdded[1];

        return $this->jsonResponder->respond(['message' => $message], $request, ['groups' => 'user:read'], $codeStatus);
    }
}
