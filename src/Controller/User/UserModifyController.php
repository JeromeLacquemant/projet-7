<?php

namespace App\Controller\User;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Services\User\Interfaces\UserModifyInterface;

class UserModifyController
{
    private $userModifyInterface;

    public function __construct(UserModifyInterface $userModifyInterface) 
    {
        $this->userModifyInterface = $userModifyInterface;
    }

     /**
     * @Route("api/users/modify/{id}", name="modify_user", methods={"PUT"})
     */
    public function modifyOneUser($id, Request $request)
    {
        $message = $this->userModifyInterface->modifyUser($id, $request);
        
        $response = new JsonResponse(['message' => $message], 200);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
