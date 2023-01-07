<?php

declare(strict_types=1);

namespace App\Services\Reply;

use App\Services\MessengerInterface;

class TextReply implements MessengerInterface
{
    public function message()
    {
        dd('テキスト');
    }
}
