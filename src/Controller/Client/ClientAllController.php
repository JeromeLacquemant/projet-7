<?php

namespace App\Controller\Client;

use App\Services\Client\Interfaces\ClientAllLoaderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientAllController
{
    private $clientAllLoaderInterface;

    public function __construct(ClientAllLoaderInterface $clientAllLoaderInterface)
    {
        $this->clientAllLoaderInterface = $clientAllLoaderInterface;
    }

    /**
     * @Route("/all-clients", name="see_all_clients", methods={"GET"})
     */
    public function seeClients(Request $request)
    {
        $response = new Response($this->clientAllLoaderInterface->loadAllClients($request), 200);
        $response->headers->set('Content-Type', 'application/json');

        $response->setMaxAge(3600);

        return $response;
    }
}
