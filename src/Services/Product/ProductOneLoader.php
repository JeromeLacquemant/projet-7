<?php

namespace App\Services\Product;

use App\Hateos\LinksConstructor;
use App\Repository\ProductRepository;
use App\Exception\ProductNotFoundException;
use Symfony\Component\Serializer\SerializerInterface;
use App\Services\Product\Interfaces\ProductOneLoaderInterface;

class ProductOneLoader implements ProductOneLoaderInterface
{
    private $productRepository;

    public function __construct(
        ProductRepository $productRepository,
        LinksConstructor $linksConstructor) 
    {
        $this->productRepository = $productRepository;
        $this->linksConstructor = $linksConstructor;
    }

    public function loadOneProduct($id){

        $product = $this->productRepository->find($id);
    
        if(is_null($product)) {
            throw new ProductNotFoundException('Le produit n\'a pas été trouvé.');
        }

        $this->linksConstructor->linksConstruction($product, $id);

        return $product;
    }
}