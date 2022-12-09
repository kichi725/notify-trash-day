<?php

declare(strict_types=1);

namespace App\Repositories\LINE;

interface MessengerRepositoryInterface
{
    public function message(array $inputs): void;
}
