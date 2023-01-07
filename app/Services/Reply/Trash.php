<?php

declare(strict_types=1);

namespace App\Services\Reply;

class Trash
{
    private $trash_type = [
        '燃えるごみ',
        '燃えないごみ',
        '資源ごみ',
        '缶・ビン',
    ];

    public function containMessage(string $message)
    {
        if (collect($this->trash_type)->contains($message)) {
        }
    }
}
