<?php

namespace App\Controller;

use App\Services\LoaderInterface;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserAllController
{
    private $loader;

    public function __construct(LoaderInterface $loader) 
    {
        $this->loader = $loader;
    }

     /**
     * @Route("/all-users", name="see_all_users")
     */
    public function seeUsers()
    {
        $response = new Response($this->loader->loadAll());
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
