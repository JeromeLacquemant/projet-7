<?php

namespace App\Services\Client;

use App\Hateos\LinksConstructor;
use App\Repository\ClientRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Services\Client\Interfaces\ClientAllLoaderInterface;

class ClientAllLoader implements ClientAllLoaderInterface
{
    private $clientRepository;

    public function __construct(
        ClientRepository $clientRepository,
        LinksConstructor $linksConstructor) 
    {
        $this->clientRepository = $clientRepository;
        $this->linksConstructor = $linksConstructor;
    }

    public function loadAllClients(Request $request){
        $page = $request->query->get('page');
        
        if(!isset($page)) {
            $page = 1;
        }

		$paginatedResult = $this->clientRepository->getClients($page);

        $this->linksConstructor->linksConstruction($paginatedResult, $request);

        return $paginatedResult;
    }
}