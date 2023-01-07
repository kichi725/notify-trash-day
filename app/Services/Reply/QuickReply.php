<?php

declare(strict_types=1);

namespace App\Services\Reply;

use App\Services\MessengerInterface;

class QuickReply implements MessengerInterface
{
    public function message()
    {
        dd('quick reply');
    }
}
