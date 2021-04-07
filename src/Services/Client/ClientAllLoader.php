<?php

namespace App\Services\Client;

use App\Repository\ClientRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Services\Client\Interfaces\ClientAllLoaderInterface;

class ClientAllLoader implements ClientAllLoaderInterface
{
    private $clientRepository;

    public function __construct(
        ClientRepository $clientRepository) 
    {
        $this->clientRepository = $clientRepository;
    }

    public function loadAllClients(Request $request){
        $page = $request->query->get('page');
        
        if(!isset($page)) {
            $page = 1;
        }
		$paginatedResult = $this->clientRepository->getClients($page);

        return $paginatedResult;
    }
}