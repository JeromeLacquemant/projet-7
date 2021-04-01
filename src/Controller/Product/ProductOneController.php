<?php

namespace App\Controller\Product;

use App\Services\Product\Interfaces\ProductOneLoaderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductOneController
{
    private $productOneLoaderInterface;

    public function __construct(ProductOneLoaderInterface $productOneLoaderInterface)
    {
        $this->productOneLoaderInterface = $productOneLoaderInterface;
    }

    /**
     * @Route("/products/{id}", name="see_one_product", methods={"GET"})
     */
    public function seeProduct($id)
    {
        $response = new Response($this->productOneLoaderInterface->loadOneProduct($id));
        $response->headers->set('Content-Type', 'application/json');

        $response->setMaxAge(3600);

        return $response;
    }
}
