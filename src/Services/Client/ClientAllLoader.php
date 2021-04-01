<?php

namespace App\Services\Client;

use App\Repository\ClientRepository;
use App\Services\Client\Interfaces\ClientAllLoaderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

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

    public function loadAllClients(Request $request)
    {
        $page = $request->query->get('page');

        if (isset($page)) {
            $page = 1;
        }
        $paginatedResult = $this->clientRepository->getClients($page);

        return $this->serializer->serialize($paginatedResult, 'json', ['groups' => 'client:read']);
    }
}
