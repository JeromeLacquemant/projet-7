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

                if($route == "see_all_users" || $route == "see_one_user") {
                        if($id == null) {
                                foreach($data as $value) {
                                         $id = $value->getId();

                                         $value->setLinks(
                                                        [
                                                        "get" => $generatedLinks,
                                                        "add" => ["rel" => $this->urlGenerator->generate($route)]
                                                        ]
                                                 );

                                                 $value->setEmbedded([
                                                        "client" => [
                                                                "id" => $value->getClient()->getId(),
                                                                "name" => $value->getClient()->getName(),
                                                                "email" => $value->getClient()->getEmail()
                                                                ]
                                                        ]
                                                );

                                                

                                         $data = $data;
                                }
                                 return $data; 
                         }
                         $data->setLinks(
                                         [
                                         "get" => $generatedLinks,
                                         "put" => $generatedLinks,
                                         "delete" => $generatedLinks
                                         ]
                                 );

                                 $data->setEmbedded([
                                        "client" => [
                                                "id" => $data->getClient()->getId(),
                                                "name" => $data->getClient()->getName(),
                                                "email" => $data->getClient()->getEmail()
                                                ]
                                        ]
                                );
         
                         return $data;
                }

                if($id == null) {
                        foreach($data as $value) {
                                 $id = $value->getId();
                                 
                                 $value->setLinks(
                                                [
                                                "get" => $generatedLinks
                                                ]
                                         );
                                 $data = $data;
                        }
                         return $data; 
                 }
                 $data->setLinks(
                                 [
                                 "get" => $generatedLinks
                                 ]
                         );
 
                 return $data;
        }   
}
       
        