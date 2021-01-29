<?php

namespace App\Controller;

use App\Interfaces\UserAllLoaderInterface;
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
     * @Route("/all-users", name="see_all_users")
     */
    public function seeUsers()
    {
        $response = new Response($this->loader->loadAllUsers());
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
