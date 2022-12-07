<?php

declare(strict_types=1);

namespace App\Repositories\LINE;

interface LineMessengerRepositoryInterface
{
    public function message(array $inputs): void;
}
