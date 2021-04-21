<?php

namespace App\Output\OutputConstructors;

use App\Output\Outputs\UserOutput;
use App\Hateos\LinksUserConstructor;
use App\Hateos\EmbeddedUserConstructor;

class UserOneOutputConstruction
{
    private $linksUserConstructor;

    public function __construct(
        LinksUserConstructor $linksUserConstructor,
        EmbeddedUserConstructor $embeddedUserConstructor) 
    {
        $this->linksUserConstructor = $linksUserConstructor;
        $this->embeddedUserConstructor = $embeddedUserConstructor;
    }

    public function outputConstruction($data, $request, $id)
    {
        $outputUser = new UserOutput();
        
        $outputUser
                ->setId($data->getId())        
                ->setUsername($data->getUsername())
                ->setPassword($data->getPassword())
                ->setEmail($data->getEmail());

        $this->linksUserConstructor->linksConstruction($outputUser, $request, $id);

        $this->embeddedUserConstructor->embeddedConstruction($data, $outputUser);
        
        return $outputUser;
    }
}