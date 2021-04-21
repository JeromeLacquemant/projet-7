<?php

namespace App\Services\Client;

use App\Hateos\LinksConstructor;
use App\Repository\ClientRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Services\Client\Interfaces\ClientAllLoaderInterface;
use App\Output\OutputConstructors\ClientAllOutputConstruction;

class ClientAllLoader implements ClientAllLoaderInterface
{
    private $clientRepository;

    public function __construct(
        ClientRepository $clientRepository,
        ClientAllOutputConstruction $clientAllOutputConstruction) 
    {
        $this->clientRepository = $clientRepository;
        $this->clientAllOutputConstruction = $clientAllOutputConstruction;
    }

    public function loadAllClients(Request $request){
        $page = $request->query->get('page');
        
        if(!isset($page)) {
            $page = 1;
        }

		$paginatedResult = $this->clientRepository->getClients($page);

        $outputClient = $this->clientAllOutputConstruction->outputConstruction($paginatedResult, $request);

        return $outputClient;
    }
}