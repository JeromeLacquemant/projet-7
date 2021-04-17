<?php

namespace App\Services\Product;

use App\Hateos\LinksConstructor;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\Product\Interfaces\ProductAllLoaderInterface;

class ProductAllLoader implements ProductAllLoaderInterface
{
    private $productRepository;

    public function __construct(
        ProductRepository $productRepository,
        LinksConstructor $linksConstructor) 
    {
        $this->productRepository = $productRepository;
        $this->linksConstructor = $linksConstructor;
    }

    public function loadAllProducts(Request $request){
        $page = $request->query->get('page');
        
        if(!isset($page)) {
            $page = 1;
        }
        
		$paginatedResult = $this->productRepository->getProducts($page);

        $this->linksConstructor->linksConstruction($paginatedResult, $request);

        return $paginatedResult;
    }
}