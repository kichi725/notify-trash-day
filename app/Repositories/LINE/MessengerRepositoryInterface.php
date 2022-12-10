<?php

declare(strict_types=1);

namespace App\Repositories\LINE;

/**
 * @package App\Repositories\LINE\
 */
interface MessengerRepositoryInterface
{
    /**
     * @param string $user_id
     * @return \App\Models\Users\User
     */
    public function getList(string $user_id): \App\Models\Users\User;

    /**
     * @param string $user_id
     * @param string $message
     * @return void
     */
    public function tempMessage(string $user_id, string $message): void;

    public function storeNotify(string $user_id, string $message): void;
}
