<?php

namespace App\Controller\Product;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\Product\Interfaces\ProductAllLoaderInterface;

class ProductAllController
{
    private $productAllLoaderInterface;

    public function __construct(ProductAllLoaderInterface $productAllLoaderInterface) 
    {
        $this->productAllLoaderInterface = $productAllLoaderInterface;
    }

    /**
     * @Route("/all-products", name="see_all_products")
     */
    public function seeProducts()
    {
        $response = new Response($this->productAllLoaderInterface->loadAllProducts());
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
