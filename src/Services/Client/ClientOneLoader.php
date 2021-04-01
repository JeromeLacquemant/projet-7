<?php

namespace App\Services\Client;

use App\Exception\ClientNotFoundException;
use App\Repository\ClientRepository;
use App\Services\Client\Interfaces\ClientOneLoaderInterface;
use Symfony\Component\Serializer\SerializerInterface;

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

    public function loadOneClient($id)
    {
        $client = $this->clientRepository->find($id);

        if (is_null($client)) {
            throw new ClientNotFoundException('Le client n\'a pas été trouvé.');
        }

        $response = $this->serializer->serialize($client, 'json', ['groups' => 'client:read']);

        return $response;
    }
}
