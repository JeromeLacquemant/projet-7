<?php

namespace App\Services\Product;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Services\Product\Interfaces\ProductAllLoaderInterface;

class ProductAllLoader implements ProductAllLoaderInterface
{
    private $productRepository;

    public function __construct(
        ProductRepository $productRepository) 
    {
        $this->productRepository = $productRepository;
    }

    public function loadAllProducts(Request $request){
        $page = $request->query->get('page');
        
        if(!isset($page)) {
            $page = 1;
        }
        
		$paginatedResult = $this->productRepository->getProducts($page);

        return $paginatedResult;
    }
}