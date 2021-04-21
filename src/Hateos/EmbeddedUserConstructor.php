<?php

namespace App\Hateos;

class EmbeddedUserConstructor
{
    public function embeddedConstruction($data, $output)
    {
        $output->setEmbedded([
                    "client" => [
                    "id" => $data->getClient()->getId(),
                    "name" => $data->getClient()->getName(),
                    "email" => $data->getClient()->getEmail()
                    ]
            ]
        );

        return $output;
    }
}