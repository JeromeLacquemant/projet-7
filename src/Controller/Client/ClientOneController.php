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
     * @Route("/clients/{id}", name="see_one_client", methods={"GET"})
     */
    public function seeClient($id, Request $request)
    {
        $client = $this->clientOneLoaderInterface->loadOneClient($id);
        
        return $this->jsonResponder->respond($client, $request, ['groups' => 'client:read'], 200);;
    }
}
