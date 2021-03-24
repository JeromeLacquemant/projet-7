<?php

namespace App\Controller\User;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\User\Interfaces\UserAllLoaderInterface;

class UserAllController
{
    private $loader;

    public function __construct(UserAllLoaderInterface $loader) 
    {
        $this->loader = $loader;
    }

     /**
     * @Route("/api/all-users", name="see_all_users")
     */
    public function seeUsers(Request $request)
    {
        $response = new Response($this->loader->loadAllUsers($request), 200);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
