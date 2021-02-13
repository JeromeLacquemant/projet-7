<?php

declare(strict_types=1);

namespace App\Services\User\Interfaces;

interface UserOneLoaderInterface
{
    public function loadOneUser($id);
}