<?php

declare(strict_types=1);

namespace App\Repositories\LINE;

use Illuminate\Http\Request;

interface LineMessengerRepositoryInterface
{
    public function message(array $inputs): void;
}
