<?php

namespace App\Output\OutputConstructors;

use App\Output\Outputs\UserOutput;
use App\Hateos\LinksUserConstructor;
use App\Hateos\EmbeddedUserConstructor;

class UserAllOutputConstruction
{
    private $linksUserConstructor;
    private $embeddedUserConstructor;

    public function __construct(
        LinksUserConstructor $linksUserConstructor,
        EmbeddedUserConstructor $embeddedUserConstructor) 
    {
        $this->linksUserConstructor = $linksUserConstructor;
        $this->embeddedUserConstructor = $embeddedUserConstructor;
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

            $this->embeddedUserConstructor->embeddedConstruction($value, $outputUser);
            
            $outputs[] = $outputUser;
        }
        
        return $outputs;
    }
}