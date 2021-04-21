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

        public function linksConstruction($data, $request, $id=null) {
                
                $route = $request->get('_route');
                
                $generatedLinks = ["rel" => $this->urlGenerator->generate($route, ['id' => $id])];

                $data->setLinks(
                        [
                        "get" => $generatedLinks
                        ]
                );
                return $data;
        }   
}
       
        