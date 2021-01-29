<?php

declare(strict_types=1);

namespace App\Interfaces;

interface UserOneLoaderInterface
{
    public function loadOneUser($id);
}