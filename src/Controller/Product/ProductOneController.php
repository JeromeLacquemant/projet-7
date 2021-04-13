<?php

namespace App\Controller\Product;

use App\Entity\Article;
use App\Responder\JsonResponder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\Product\Interfaces\ProductOneLoaderInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ProductOneController
{
    private $productOneLoaderInterface;
    private $urlGenerator;

    public function __construct(
        ProductOneLoaderInterface $productOneLoaderInterface,
        JsonResponder $jsonResponder,
        UrlGeneratorInterface $urlGenerator) 
    {
        $this->productOneLoaderInterface = $productOneLoaderInterface;
        $this->jsonResponder = $jsonResponder;
        $this->urlGenerator = $urlGenerator;
    }

     /**
     * @Route("/products/{id}", name="see_one_product", methods={"GET"})
     */
    public function seeProduct($id, Request $request)
    {
        $user = $this->productOneLoaderInterface->loadOneProduct($id);


        return $this->jsonResponder->respond($user, $request, [], 200);
    }
}
