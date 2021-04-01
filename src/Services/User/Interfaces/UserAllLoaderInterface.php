<?php

declare(strict_types=1);

namespace App\Services\User\Interfaces;

use Symfony\Component\HttpFoundation\Request;

interface UserAllLoaderInterface
{
    public function loadAllUsers(Request $request);
}
