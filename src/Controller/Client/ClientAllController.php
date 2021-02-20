<?php

namespace App\Controller\Client;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\Client\Interfaces\ClientAllLoaderInterface;

class ClientAllController
{
    private $clientAllLoaderInterface;

    public function __construct(ClientAllLoaderInterface $clientAllLoaderInterface) 
    {
        $this->clientAllLoaderInterface = $clientAllLoaderInterface;
    }
    /**
     * @Route("/all-clients", name="see_all_clients")
     */
    public function seeClients()
    {
        $response = new Response($this->clientAllLoaderInterface->loadAllClients());
        $response->headers->set('Content-Type', 'application/json');

        //Cache privately for 5 seconds
        $response->setMaxAge(5);

        return $response;
    }
}