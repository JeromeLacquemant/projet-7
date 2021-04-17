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

                if($id == null) {
                       foreach($data as $value) {
                                $id = $value->getId();
                                $value->setLinks(["rel" => $this->urlGenerator->generate($route, ['id' => $id])]);
                                $data = $data;
                       }
                        return $data; 
                }
                $data->setLinks(["rel" => $this->urlGenerator->generate($route, ['id' => $id])]);

                return $data;
        }   
}
       
        