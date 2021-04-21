<?php

namespace App\Output\OutputConstructors;

use App\Entity\Product;
use App\Hateos\LinksConstructor;
use App\Output\Outputs\ClientOutput;
use App\Output\Outputs\ProductOutput;
use Behat\Testwork\Output\Printer\OutputPrinter;

class ProductOneOutputConstruction
{
    private $linksConstructor;

    public function __construct(
        LinksConstructor $linksConstructor) 
    {
        $this->linksConstructor = $linksConstructor;
    }

    public function outputConstruction($data, $request, $id=null)
    {
        $outputProduct = new ProductOutput();
        $outputProduct
                ->setId($data->getId())
                ->setName($data->getName())
                ->setDescription($data->getDescription())
                ->setPrice($data->getPrice());
    
        $this->linksConstructor->linksConstruction($outputProduct, $request, $id);

        return $outputProduct;
    }
}