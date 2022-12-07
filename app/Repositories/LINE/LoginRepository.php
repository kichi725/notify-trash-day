<?php

declare(strict_types=1);

namespace App\Repositories\LINE;

use App\Models\User;

class LoginRepository implements LoginRepositoryInterface
{
    /**
     * 登録済みユーザーを取得
     *
     * @param string $user_id
     * @return \App\Models\User
     */
    public function getUser(string $user_id): User
    {
        return User::whereLineId($user_id)->first();
    }

    /**
     * ログイン情報登録
     *
     * @param array $profile
     * @return void
     */
    public function store(array $profile): void
    {
        User::create([
            'provider' => 'line',
            'line_id'  => $profile['userId'],
            'name'     => $profile['displayName'],
        ]);
    }
}
