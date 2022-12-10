<?php

declare(strict_types=1);

namespace App\Services\LINE;

use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot\MessageBuilder\RawMessageBuilder;

/**
 * @package App\Services\LINE\
 */
class MessengerServices
{
    /**
     * 返信用メッセージ：週選択
     * @var int
     */
    private const MESSAGE_WEEKS = 0;
    /**
     * 返信用メッセージ：ごみ選択
     * @var int
     */
    private const MESSAGE_TRASH = 1;

    /**
     * @var \LINE\LINEBot
     */
    private $bot;

    /**
     * @return void
     */
    public function __construct(
        private \App\Repositories\LINE\MessengerRepositoryInterface $repository
    ) {
        $http_client    = new CurlHTTPClient(config('services.line.channel_token'));
        $channel_secret = ['channelSecret' => config('services.line.messenger_secret')];

        $this->bot = new LINEBot($http_client, $channel_secret);
    }

    /**
     * 受信メッセージ別処理
     *
     * @param array $request
     * @return void
     */
    public function webhook(array $request): void
    {
        // メッセージ内容を取得
        $request_message = $request['message']['text'];
        // replyTokenを取得
        $reply_token = $request['replyToken'];

        $user_id = $request['source']['userId'];
        info('リクエスト', ['message' => $request_message]);

        switch ($request_message) {
            case '曜日とごみの種類を登録する':
                $this->replySelectWeek($reply_token, $user_id);

                break;
            case '登録内容を確認する':
                $this->replyShowList($reply_token, $user_id);

                break;
            default:
                if (collect(['燃えるごみ', '燃えないごみ', '資源ごみ', '缶・ビン'])->contains($request_message)) {
                    // dbアクセス必要
                    // user_id, 有効期限, 選択された曜日をDBから取得
                    // 通知設定テーブルに保存
                    $this->repository->storeNotify($user_id, $request_message);
                    $this->bot->replyText($reply_token, '登録しました！');
                } else {
                    $this->replySelectTrash($reply_token, $request_message, $user_id);
                }

                break;
        }
    }

    /**
     * 通知曜日選択の返信
     *
     * @param string $reply_token
     * @return void
     */
    public function replySelectWeek(string $reply_token): void
    {
        // メッセージテンプレート取得
        $templete = $this->createQuickReplyMessages(self::MESSAGE_WEEKS);

        // dbアクセス必要 <- いるか?

        // クイックリプライ
        $reply_message = new RawMessageBuilder($templete);
        $this->bot->replyMessage($reply_token, $reply_message);
    }

    /**
     * 通知するごみの種類を選択
     *
     * @param string $reply_token
     * @param string $user_id
     * @return void
     */
    public function replySelectTrash(string $reply_token, string $request_message, string $user_id): void
    {
        // メッセージテンプレート取得
        $templete = $this->createQuickReplyMessages(self::MESSAGE_TRASH);

        // dbアクセス必要
        // user_id, 有効期限, 選択された曜日をDBに保存
        $this->repository->tempMessage($user_id, $request_message);

        // クイックリプライ
        $reply_message = new RawMessageBuilder($templete);
        $this->bot->replyMessage($reply_token, $reply_message);
    }

    /**
     * 通知日登録クイックリプライメッセージを作成
     *
     * @return array
     */
    public function createQuickReplyMessages(int $type): array
    {
        $text = [
            '登録する曜日を選択してください',
            'ごみの種類を選択してください',
        ];

        return [
            'type'       => 'text',
            'text'       => $text[$type],
            'quickReply' => [
                'items' => $this->getItems($type),
            ],
        ];
    }

    /**
     * 曜日の選択肢を作成（クイックリプライで使用）
     *
     * @return array
     */
    public function getItems(int $type): array
    {
        $items = [
            ['月', '火', '水', '木', '金', '土', '日'],
            ['燃えるごみ', '燃えないごみ', '資源ごみ', '缶・ビン'],
        ];

        return collect($items[$type])
        ->map(fn ($item) => [
            'type'   => 'action',
            'action' => [
                'type'  => 'message',
                'label' => $item,
                'text'  => $item,
            ],
        ])->all();
    }

    /**
     * 通知曜日リスト
     *
     * @param string $reply_token
     * @return void
     */
    public function replyShowList(string $reply_token, string $user_id): void
    {
        // DBアクセス必要
        $list          = $this->repository->getList($user_id);
        $reply_message = <<<EOM
        ご登録頂いた日時です。
        月曜日: {$list['monday']['trash']}
        火曜日: {$list['tuesday']['trash']}
        水曜日: {$list['wednesday']['trash']}
        木曜日: {$list['thursday']['trash']}
        金曜日: {$list['friday']['trash']}
        土曜日: {$list['saturday']['trash']}
        日曜日: {$list['sunday']['trash']}
        EOM;

        $this->bot->replyText($reply_token, $reply_message);
    }
}
