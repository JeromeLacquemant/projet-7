<?php

namespace App\Output\OutputConstructors;

use App\Output\Outputs\UserOutput;
use App\Hateos\LinksUserConstructor;

class UserAllOutputConstruction
{
    private $linksUserConstructor;

    public function __construct(
        LinksUserConstructor $linksUserConstructor) 
    {
        $this->linksUserConstructor = $linksUserConstructor;
    }

    public function outputConstruction($data, $request)
    {
        foreach ($data as $value) {   
            $outputUser = new UserOutput();
            $outputUser
                ->setId($value->getId())        
                ->setUsername($value->getUsername())
                ->setPassword($value->getPassword())
                ->setEmail($value->getEmail());

            $this->linksUserConstructor->linksConstruction($outputUser, $request);
            
            $outputs[] = $outputUser;
        }
        
        return $outputs;
    }
}