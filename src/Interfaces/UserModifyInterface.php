<?php

declare(strict_types=1);

namespace App\Interfaces;

use Symfony\Component\HttpFoundation\Request;

interface UserModifyInterface
{
    public function modifyUser($id, Request $request);
}