<?php

namespace App\Services\Client;

use App\Repository\ClientRepository;
use App\Exception\ClientNotFoundException;
use App\Services\Client\Interfaces\ClientOneLoaderInterface;

class ClientOneLoader implements ClientOneLoaderInterface
{
    private $clientRepository;

    public function __construct(
        ClientRepository $clientRepository) 
    {
        $this->clientRepository = $clientRepository;
    }

    public function loadOneClient($id){

        $client = $this->clientRepository->find($id);

        if(is_null($client)) {
            throw new ClientNotFoundException('Le client n\'a pas été trouvé.');
        }

        return $client;
    }
}