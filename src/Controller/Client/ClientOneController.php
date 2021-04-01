<?php

namespace App\Controller\Client;

use App\Services\Client\Interfaces\ClientOneLoaderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientOneController
{
    private $clientOneLoaderInterface;

    public function __construct(ClientOneLoaderInterface $clientOneLoaderInterface)
    {
        $this->clientOneLoaderInterface = $clientOneLoaderInterface;
    }

    /**
     * @Route("/clients/{id}", name="see_one_client", methods={"GET"})
     */
    public function seeClient($id)
    {
        $response = new Response($this->clientOneLoaderInterface->loadOneClient($id));
        $response->headers->set('Content-Type', 'application/json');

        $response->setMaxAge(3600);

        return $response;
    }
}
