<?php

declare(strict_types=1);

namespace App\Services\Client\Interfaces;

interface ClientOneLoaderInterface
{
    public function loadOneClient($id);
}
