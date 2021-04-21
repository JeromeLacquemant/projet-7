<?php

namespace App\Services\Product;

use App\Repository\ProductRepository;
use App\Exception\ProductNotFoundException;
use App\Output\OutputConstructors\ProductOneOutputConstruction;
use App\Services\Product\Interfaces\ProductOneLoaderInterface;

class ProductOneLoader implements ProductOneLoaderInterface
{
    private $productRepository;

    public function __construct(
        ProductRepository $productRepository,
        ProductOneOutputConstruction $productOneOutputConstruction) 
    {
        $this->productRepository = $productRepository;
        $this->productOneOutputConstruction = $productOneOutputConstruction;
    }

    public function loadOneProduct($id, $request){

        $product = $this->productRepository->find($id);
    
        if(is_null($product)) {
            throw new ProductNotFoundException('Le produit n\'a pas été trouvé.');
        }

        $outputProduct = $this->productOneOutputConstruction->outputConstruction($product, $request, $id);

        return $outputProduct;
    }
}