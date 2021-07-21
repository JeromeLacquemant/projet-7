<?php

namespace App\Output\OutputConstructors;

use App\Hateos\LinksConstructor;
use App\Output\Outputs\ClientOutput;

class ClientOneOutputConstruction
{
    private $linksConstructor;

    public function __construct(
        LinksConstructor $linksConstructor) 
    {
        $this->linksConstructor = $linksConstructor;
    }

    public function outputConstruction($data, $request, $id)
    {
        $outputClient = new ClientOutput();
        
        $outputClient
                ->setId($data->getId())        
                ->setUsername($data->getName())
                ->setEmail($data->getEmail());

        $this->linksConstructor->linksConstruction($outputClient, $request, $id);

        return $outputClient;
    }
}