<?php

namespace App\Controller\User;

use App\Services\User\Interfaces\UserAllLoaderInterface;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserAllController
{
    private $loader;

    public function __construct(UserAllLoaderInterface $loader)
    {
        $this->loader = $loader;
    }

    /**
     *     @OA\Response(
     *     response=200,
     *     description="Returns the rewards of an user")
     *
     * @Route("/api/all-users", name="see_all_users", methods={"GET"})
     */
    public function seeUsers(Request $request)
    {
        $response = new Response($this->loader->loadAllUsers($request), 200);
        $response->headers->set('Content-Type', 'application/json');

        $response->setMaxAge(3600);

        return $response;
    }
}
