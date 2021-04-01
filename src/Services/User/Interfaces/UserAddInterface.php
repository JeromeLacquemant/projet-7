<?php

declare(strict_types=1);

namespace App\Services\User\Interfaces;

use Symfony\Component\HttpFoundation\Request;

interface UserAddInterface
{
    public function addUser(Request $request);
}
