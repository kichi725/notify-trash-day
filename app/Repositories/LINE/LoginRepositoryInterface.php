<?php

declare(strict_types=1);

namespace App\Repositories\LINE;

interface LoginRepositoryInterface
{
    /**
     * @param string $user_id
     * @return \App\Models\User
     */
    public function getUser(string $user_id): \App\Models\User;

    /**
     * @param array $profile
     * @return void
     */
    public function store(array $profile): void;
}
