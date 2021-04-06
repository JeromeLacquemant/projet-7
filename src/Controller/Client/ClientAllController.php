<?php

namespace App\Controller\Client;

use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/clients", name="see_all_clients", methods={"GET"})
     */
    public function seeClients(Request $request)
    {
        $response = new Response($this->clientAllLoaderInterface->loadAllClients($request), 200);
        $response->headers->set('Content-Type', 'application/json');

        $response->setMaxAge(3600);

        return $response;
    }
}
