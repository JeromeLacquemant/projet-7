<?php

namespace App\Services\Client;

use App\Repository\ClientRepository;
use App\Exception\ClientNotFoundException;
use App\Services\Client\Interfaces\ClientOneLoaderInterface;
use App\Output\OutputConstructors\ClientOneOutputConstruction;


class ClientOneLoader implements ClientOneLoaderInterface
{
    private $clientRepository;

    public function __construct(
        ClientRepository $clientRepository,
        ClientOneOutputConstruction $clientOneOutputConstruction) 
    {
        $this->clientRepository = $clientRepository;
        $this->clientOneOutputConstruction = $clientOneOutputConstruction;
    }

    public function loadOneClient($id, $request){

        $client = $this->clientRepository->find($id);

        if(is_null($client)) {
            throw new ClientNotFoundException('Le client n\'a pas été trouvé.');
        }
        
        $outputClient = $this->clientOneOutputConstruction->outputConstruction($client, $request, $id);

        return $outputClient;
    }
}