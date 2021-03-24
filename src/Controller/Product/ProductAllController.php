<?php

namespace App\Controller\Product;

use Symfony\Component\HttpFoundation\Request;
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
    public function seeProducts(Request $request)
    {
        $response = new Response($this->productAllLoaderInterface->loadAllProducts($request), 200);
        $response->headers->set('Content-Type', 'application/json');

        $response->setMaxAge(3600);

        return $response;
    }
}
