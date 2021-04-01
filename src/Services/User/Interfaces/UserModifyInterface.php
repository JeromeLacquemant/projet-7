<?php

declare(strict_types=1);

namespace App\Services\User\Interfaces;

use Symfony\Component\HttpFoundation\Request;

interface UserModifyInterface
{
    public function modifyUser($id, Request $request);
}
