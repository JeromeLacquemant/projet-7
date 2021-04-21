<?php

namespace App\Output\OutputConstructors;

use App\Hateos\LinksConstructor;
use App\Output\Outputs\UserOutput;

class UserAllOutputConstruction
{
    private $linksConstructor;

    public function __construct(
        LinksConstructor $linksConstructor) 
    {
        $this->linksConstructor = $linksConstructor;
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

            $this->linksConstructor->linksConstruction($outputUser, $request);
            
            $outputs[] = $outputUser;
        }
        
        return $outputs;
    }
}