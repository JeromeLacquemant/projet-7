<?php

declare(strict_types=1);

namespace App\Services\Product\Interfaces;

use Symfony\Component\HttpFoundation\Request;

interface ProductAllLoaderInterface
{
    public function loadAllProducts(Request $request);
}
