<?php

namespace App\Services\Product;

use App\Repository\ProductRepository;
use Symfony\Component\Serializer\SerializerInterface;
use App\Services\Product\Interfaces\ProductOneLoaderInterface;

class ProductOneLoader implements ProductOneLoaderInterface
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

    public function loadOneProduct($id){

        $product = $this->productRepository->find($id);
    
        $response = $this->serializer->serialize($product, "json");

        return $response;
    }
}