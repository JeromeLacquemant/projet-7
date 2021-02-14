<?php

declare(strict_types=1);

namespace App\Services\Product\Interfaces;

interface ProductOneLoaderInterface
{
    public function loadOneProduct($id);
}