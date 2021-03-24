<?php

declare(strict_types=1);

namespace App\Services\Client\Interfaces;

use Symfony\Component\HttpFoundation\Request;

interface ClientAllLoaderInterface
{
    public function loadAllClients(Request $request);
}