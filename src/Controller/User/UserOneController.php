<?php

namespace App\Controller\User;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\User\Interfaces\UserOneLoaderInterface;

class UserOneController
{
    private $loader;

    public function __construct(UserOneLoaderInterface $loader) 
    {
        $this->loader = $loader;
    }

     /**
     * @Route("api/users/{id}", name="see_one_user")
     */
    public function seeUser($id)
    {
        $response = new Response($this->loader->loadOneUser($id));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
