<?php

namespace App\Hateos;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class LinksConstructor
{
        private $urlGenerator;

        public function __construct(
                UrlGeneratorInterface $urlGenerator)
        {
                $this->urlGenerator = $urlGenerator;
        }

        public function linksConstruction($data, $id) {
        
                $data->setLinks(["rel" => $this->urlGenerator->generate("see_one_product", ['id' => $id])]);

                return $data;
        }
        
}
       
        