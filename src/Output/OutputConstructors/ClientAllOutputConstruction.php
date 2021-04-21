<?php

namespace App\Output\OutputConstructors;

use App\Hateos\LinksConstructor;
use App\Output\Outputs\ClientOutput;

class ClientAllOutputConstruction
{
    private $linksConstructor;

    public function __construct(
        LinksConstructor $linksConstructor) 
    {
        $this->linksConstructor = $linksConstructor;
    }

    public function outputConstruction($data, $request)
    {
        if($data == null) {
            $outputs = [];
            return $outputs;
        }
        
        foreach ($data as $value) {   
            $outputClient = new ClientOutput();
            $outputClient
                ->setId($value->getId())        
                ->setUsername($value->getName())
                ->setPassword($value->getPassword())
                ->setEmail($value->getEmail());
            
            $this->linksConstructor->linksConstruction($outputClient, $request);
            
            $outputs[] = $outputClient;
        }
        
        return $outputs;
    }
}