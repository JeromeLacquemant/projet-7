<?php

namespace App\Output\OutputConstructors;

use App\Hateos\LinksConstructor;
use App\Output\Outputs\UserOutput;

class UserOneOutputConstruction
{
    private $linksConstructor;

    public function __construct(
        LinksConstructor $linksConstructor) 
    {
        $this->linksConstructor = $linksConstructor;
    }

    public function outputConstruction($data, $request, $id)
    {
        $outputClient = new UserOutput();
        
        $outputClient
                ->setId($data->getId())        
                ->setUsername($data->getUsername())
                ->setPassword($data->getPassword())
                ->setEmail($data->getEmail());

        $this->linksConstructor->linksConstruction($outputClient, $request, $id);

        return $outputClient;
    }
}