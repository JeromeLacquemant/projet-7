<?php

namespace App\Services\Client;

use App\Repository\ClientRepository;
use Symfony\Component\Serializer\SerializerInterface;
use App\Services\Client\Interfaces\ClientOneLoaderInterface;

class ClientOneLoader implements ClientOneLoaderInterface
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

    public function loadOneClient($id){

        $product = $this->clientRepository->find($id);
    
        $response = $this->serializer->serialize($product, "json");

        return $response;
    }
}