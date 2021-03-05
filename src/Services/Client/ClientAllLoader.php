<?php

namespace App\Services\Client;

use App\Repository\ClientRepository;
use Symfony\Component\Serializer\SerializerInterface;
use App\Services\Client\Interfaces\ClientAllLoaderInterface;

class ClientAllLoader implements ClientAllLoaderInterface
{
    private $clientRepository;
    private $serializer;

    public function __construct(
        ClientRepository $clientRepository,
        SerializerInterface $serializer) 
    {
        $this->clientRepository = $clientRepository;
        $this->serializer = $serializer;
    }

    public function loadAllClients(){
        $data = $this->clientRepository->findAll();
 
        $response = $this->serializer->serialize($data, "json", ['groups' => 'client:read']);

        return $response;
    }
}