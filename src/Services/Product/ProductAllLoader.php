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
        $data = $this->productRepository->findAll();
 
        return $this->serializer->serialize($data, "json");
    }
}