<?php

namespace App\Controller\Product;

use App\Responder\JsonResponder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\Product\Interfaces\ProductAllLoaderInterface;

class ProductAllController
{
    private $productAllLoaderInterface;

    public function __construct(
        ProductAllLoaderInterface $productAllLoaderInterface,
        JsonResponder $jsonResponder) 
    {
        $this->productAllLoaderInterface = $productAllLoaderInterface;
        $this->jsonResponder = $jsonResponder;
    }
    
    /**
     * @Route("/products", name="see_all_products")
     */
    public function seeProducts(Request $request)
    {
        $users = $this->productAllLoaderInterface->loadAllProducts($request);

        return $this->jsonResponder->respond($users, $request, 200);
    }
}
