<?php

namespace App\Hateos;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class LinksUserConstructor
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
                
                if($id == null) {
                        $id = $data->getId();
                        $data->setLinks(
                                [
                                "get" => $generatedLinks,
                                "add" => ["rel" => $this->urlGenerator->generate($route)]
                                ]
                        );
                        return $data; 
                }
                         
                $data->setLinks(
                        [
                        "get" => $generatedLinks,
                        "put" => $generatedLinks,
                        "delete" => $generatedLinks
                        ]
                );

                return $data;
        }   
}
       
        