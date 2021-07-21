<?php

namespace App\Controller\Client;

use App\Responder\JsonResponder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\Client\Interfaces\ClientOneLoaderInterface;

class ClientOneController
{
    private $clientOneLoaderInterface;
    private $jsonResponder;

    public function __construct(
        ClientOneLoaderInterface $clientOneLoaderInterface,
        JsonResponder $jsonResponder) 
    {
        $this->clientOneLoaderInterface = $clientOneLoaderInterface;
        $this->jsonResponder = $jsonResponder;
    }

     /**
     * @Route("api/clients/{id}", name="see_one_client", methods={"GET"})
     */
    public function seeClient($id, Request $request)
    {
        $client = $this->clientOneLoaderInterface->loadOneClient($id, $request);

        return $this->jsonResponder->respond($client, $request, 200);;
    }
}
