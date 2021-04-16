<?php

namespace App\Services\Client;

use App\Repository\ClientRepository;
use App\Exception\ClientNotFoundException;
use App\Hateos\LinksConstructor;
use App\Services\Client\Interfaces\ClientOneLoaderInterface;

class ClientOneLoader implements ClientOneLoaderInterface
{
    private $clientRepository;

    public function __construct(
        ClientRepository $clientRepository,
        LinksConstructor $linksConstructor) 
    {
        $this->clientRepository = $clientRepository;
        $this->linksConstructor = $linksConstructor;
    }

    public function loadOneClient($id, $request){

        $client = $this->clientRepository->find($id);

        if(is_null($client)) {
            throw new ClientNotFoundException('Le client n\'a pas été trouvé.');
        }

        $this->linksConstructor->linksConstruction($client, $request, $id);

        return $client;
    }
}