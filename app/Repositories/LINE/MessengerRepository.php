<?php

declare(strict_types=1);

namespace App\Repositories\LINE;

use App\Models\Temporaries\Temporary;
use App\Models\Users\User;
use App\Models\Weeks\Monday;

/**
 * @package \App\Repositories\LINE
 */
class MessengerRepository implements MessengerRepositoryInterface
{
    /**
     * 登録済み通知リストを取得
     *
     * @param string $user_id
     * @return \App\Models\Users\User
     */
    public function getList(string $user_id): User
    {
        $with = [
            'monday:user_id,trash',
            'tuesday:user_id,trash',
            'wednesday:user_id,trash',
            'thursday:user_id,trash',
            'friday:user_id,trash',
            'saturday:user_id,trash',
            'sunday:user_id,trash',
        ];

        return User::with($with)->whereUserId($user_id)->first();
    }

    /**
     * 選択された曜日を保存
     *
     * @param string $user_id
     * @param string $message
     * @return void
     */
    public function tempMessage(string $user_id, string $message): void
    {
        Temporary::create([
            'user_id'    => $user_id,
            'content'    => $message,
            'expired_at' => now()->addMinute(), // 有効期限1分
        ]);
    }

    public function storeNotify($user_id, $request_message): void
    {
        $week = $this->getTempWeek($user_id);

        Monday::updateOrCreate([
            'user_id' => $user_id,
            'trash'   => $request_message,
        ]);
    }

    /**
     * @param string $user_id
     * @throws \Exception
     * @return string
     */
    public function getTempWeek(string $user_id): string
    {
        // 一時保存の曜日を取得
        $week = Temporary::whereUserId($user_id)
            ->where('expired_at', '>', now())
            ->first(['content']);

        throw_if(is_null($week), \Exception::class, 'Error');

        return $week['content'];
    }
}
