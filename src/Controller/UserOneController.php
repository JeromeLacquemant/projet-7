<?php

namespace App\Controller;

use App\Interfaces\UserOneLoaderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserOneController
{
    private $loader;

    public function __construct(UserOneLoaderInterface $loader) 
    {
        $this->loader = $loader;
    }

     /**
     * @Route("/users/{id}", name="see_one_user")
     */
    public function seeUser($id)
    {
        $response = new Response($this->loader->loadOneUser($id));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
