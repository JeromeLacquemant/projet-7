<?php

namespace App\Services\Product;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use App\Services\Product\Interfaces\ProductAllLoaderInterface;

class ProductAllLoader implements ProductAllLoaderInterface
{
    private $productRepository;
    private $serializer;

    public function __construct(
        ProductRepository $productRepository,
        SerializerInterface $serializer) 
    {
        $this->productRepository = $productRepository;
        $this->serializer = $serializer;
    }

    public function loadAllProducts(Request $request){
        $page = $request->query->get('page');
        
        if(isset($page)) {
            $page = 1;
        }
        
		$paginatedResult = $this->productRepository->getProducts($page);

        return $this->serializer->serialize($paginatedResult, "json");
    }
}