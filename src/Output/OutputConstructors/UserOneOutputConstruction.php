<?php

namespace App\Output\OutputConstructors;

use App\Output\Outputs\UserOutput;
use App\Hateos\LinksUserConstructor;

class UserOneOutputConstruction
{
    private $linksUserConstructor;

    public function __construct(
        LinksUserConstructor $linksUserConstructor) 
    {
        $this->linksUserConstructor = $linksUserConstructor;
    }

    public function outputConstruction($data, $request, $id)
    {
        $outputClient = new UserOutput();
        
        $outputClient
                ->setId($data->getId())        
                ->setUsername($data->getUsername())
                ->setPassword($data->getPassword())
                ->setEmail($data->getEmail());

        $this->linksUserConstructor->linksConstruction($outputClient, $request, $id);

        return $outputClient;
    }
}