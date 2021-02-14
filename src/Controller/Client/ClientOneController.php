<?php

namespace App\Controller\Client;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\Client\Interfaces\ClientOneLoaderInterface;

class ClientOneController
{
    private $clientOneLoaderInterface;

    public function __construct(ClientOneLoaderInterface $clientOneLoaderInterface) 
    {
        $this->clientOneLoaderInterface = $clientOneLoaderInterface;
    }

     /**
     * @Route("/clients/{id}", name="see_one_client")
     */
    public function seeClient($id)
    {
        $response = new Response($this->clientOneLoaderInterface->loadOneClient($id));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
