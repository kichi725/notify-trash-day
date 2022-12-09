<?php

namespace App\Services\LINE;

use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;

class MessengerServices
{
    /** @var \LINE\LINEBot */
    private $bot;

    public function __construct()
    {
        $http_client    = new CurlHTTPClient(config('services.line.channel_token'));
        $channel_secret = ['channelSecret' => config('services.line.messenger_secret')];

        $this->bot = new LINEBot($http_client, $channel_secret);
    }

    public function webhook(array $request): void
    {
        // メッセージ内容を取得
        $request_message = $request['message']['text'];
        // replyTokenを取得
        $reply_token = $request['replyToken'];

        $user_id = $request['source']['userId'];

        switch ($request_message) {
            case '登録する':
                $this->selectWeek($reply_token, $user_id);

                break;
            case '確認する':
                $this->showList($reply_token, $user_id);

                break;
            default:
                $this->selectTrash($reply_token, $user_id);

                break;
        }
    }

    /**
     * 通知日時の登録
     *
     * @param string $reply_token
     * @return void
     */
    public function selectWeek(string $reply_token): void
    {
        $quick_reply_messages = $this->createQuickReplyMessages();

        // dbアクセス必要

        // クイックリプライ
        $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\RawMessageBuilder($quick_reply_messages);
        $response           = $this->bot->replyMessage($reply_token, $textMessageBuilder);
    }

    /**
     * 通知日時リスト
     *
     * @param string $reply_token
     * @return void
     */
    public function showList(string $reply_token): void
    {
        // DBアクセス必要
        $reply_message = "ご登録頂いた日時です。\n月曜日: なし\n火曜日: 燃えるごみ";

        $reply =$this->bot->replyText($reply_token, $reply_message);
    }

    public function selectTrash(string $reply_token, string $user_id): void
    {
    }

    /**
     * 通知日登録クイックリプライメッセージを作成
     *
     * @return array
     */
    public function createQuickReplyMessages(): array
    {
        return [
            'type'       => 'text',
            'text'       => '登録する曜日を選択してください',
            'quickReply' => [
                'items' => $this->getWeekItems(),
            ],
        ];
    }

    /**
     * 曜日の選択肢を作成（クイックリプライで使用）
     *
     * @return array
     */
    public function getWeekItems(): array
    {
        return collect(['月', '火', '水', '木', '金', '土', '日'])
            ->map(fn ($week) => [
                'type'   => 'action',
                'action' => [
                    'type'  => 'message',
                    'label' => $week,
                    'text'  => $week,
                ],
            ])->all();
    }
}
