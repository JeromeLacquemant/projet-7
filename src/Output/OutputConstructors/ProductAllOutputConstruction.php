<?php

namespace App\Output\OutputConstructors;

use App\Entity\Product;
use App\Hateos\LinksConstructor;
use App\Output\Outputs\ClientOutput;
use App\Output\Outputs\ProductOutput;
use Behat\Testwork\Output\Printer\OutputPrinter;

class ProductAllOutputConstruction
{
    private $linksConstructor;

    public function __construct(
        LinksConstructor $linksConstructor) 
    {
        $this->linksConstructor = $linksConstructor;
    }

    public function outputConstruction($data, $request)
    {
        foreach ($data as $value) {   
            $outputProduct = new ProductOutput();
            $outputProduct
                    ->setId($value->getId())
                    ->setName($value->getName())
                    ->setDescription($value->getDescription())
                    ->setPrice($value->getPrice());
            
            $this->linksConstructor->linksConstruction($outputProduct, $request);
            
            $outputs[] = $outputProduct;
        }

        return $outputs;
    }
}