<?php

namespace App\Services\Product;

use App\Exception\ProductNotFoundException;
use App\Repository\ProductRepository;
use App\Services\Product\Interfaces\ProductOneLoaderInterface;
use Symfony\Component\Serializer\SerializerInterface;

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

    public function loadOneProduct($id)
    {
        $product = $this->productRepository->find($id);

        if (is_null($product)) {
            throw new ProductNotFoundException('Le produit n\'a pas été trouvé.');
        }

        $response = $this->serializer->serialize($product, 'json');

        return $response;
    }
}
