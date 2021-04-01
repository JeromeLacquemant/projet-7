<?php

namespace App\Controller\User;

use App\Services\User\Interfaces\UserOneLoaderInterface;
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
     * @Route("api/users/{id}", name="see_one_user", methods={"GET"})
     */
    public function seeUser($id)
    {
        $response = new Response($this->loader->loadOneUser($id), 200);
        $response->headers->set('Content-Type', 'application/json');

        $response->setMaxAge(3600);

        return $response;
    }
}
