<?php

declare(strict_types=1);

namespace App\Services\User\Interfaces;

interface UserDeleteInterface
{
    public function deleteUser($id);
}