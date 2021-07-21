<?php

namespace App\Controller\Client;

use App\Responder\JsonResponder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\Client\Interfaces\ClientAllLoaderInterface;

class ClientAllController
{
    private $clientAllLoaderInterface;

    public function __construct(
        ClientAllLoaderInterface $clientAllLoaderInterface,
        JsonResponder $jsonResponder) 
    {
        $this->clientAllLoaderInterface = $clientAllLoaderInterface;
        $this->jsonResponder = $jsonResponder;
    }
    /**
     * @Route("api/clients", name="see_all_clients", methods={"GET"})
     */
    public function seeClients(Request $request)
    {
        $clients = $this->clientAllLoaderInterface->loadAllClients($request);

        return $this->jsonResponder->respond($clients, $request, 200);
    }
}
