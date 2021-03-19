<?php

namespace App\Services\Product;

use App\Repository\ProductRepository;
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

    public function loadAllProducts(){
        // Get the first page of products
		$paginatedResult = $this->productRepository->getProducts(2);
		// get the total number of products
		$totalOrder = count($paginatedResult);
        
        //$data = $this->productRepository->getAllProductQueryBuilder();
 
        return $this->serializer->serialize($paginatedResult, "json");
    }
}