<?php

namespace App\Services\LINE;

use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;

class ReplyServices
{
    public function message(array $inputs): void
    {
        // そこからtypeをとりだし、$message_typeに代入
        $message_type=$inputs[0]['type'];

        // メッセージ内容を取得
        $request_message = $inputs[0]['message']['text'];

        // replyTokenを取得
        $reply_token=$inputs[0]['replyToken'];

        // LINEBOTSDKの設定
        $http_client = new CurlHTTPClient(config('services.line.channel_token'));
        $bot = new LINEBot($http_client, ['channelSecret' => config('services.line.messenger_secret')]);

        if ($request_message === 'store') {
            $quick_reply_messages = [
                'type' => 'text',
                'text' => '燃えるゴミの日を登録してください。',
                'quickReply' => [
                    'items' => [
                        [
                            'type'   => 'action',
                            'action' => [
                                'type'  => 'message',
                                'label' => '月曜日',
                                'text'  => '月曜日',
                            ],
                        ],
                        [
                            'type'   => 'action',
                            'action' => [
                                'type'  => 'message',
                                'label' => '火曜日',
                                'text'  => '火曜日',
                            ],
                        ],
                        [
                            'type'   => 'action',
                            'action' => [
                                'type'  => 'message',
                                'label' => '水曜日',
                                'text'  => '水曜日',
                            ],
                        ],
                        [
                            'type'   => 'action',
                            'action' => [
                                'type'  => 'message',
                                'label' => '木曜日',
                                'text'  => '木曜日',
                            ],
                        ],
                        [
                            'type'   => 'action',
                            'action' => [
                                'type'  => 'message',
                                'label' => '金曜日',
                                'text'  => '金曜日',
                            ],
                        ],
                        [
                            'type'   => 'action',
                            'action' => [
                                'type'  => 'message',
                                'label' => '土曜日',
                                'text'  => '土曜日',
                            ],
                        ],
                        [
                            'type'   => 'action',
                            'action' => [
                                'type'  => 'message',
                                'label' => '日曜日',
                                'text'  => '日曜日',
                            ],
                        ],
                    ],
                ],
            ];

            // クイックリプライ
            $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\RawMessageBuilder($quick_reply_messages);
            $response = $bot->replyMessage($reply_token, $textMessageBuilder);
        }
        if ($request_message === 'index') {
            $reply_message = "ご登録頂いた日時です。\n月曜日: なし\n火曜日: 燃えるごみ";
            $reply=$bot->replyText($reply_token, $reply_message);
        }
        if ($request_message === 'update') {
            $reply_message = 'どの曜日を変更しますか？';
            $reply=$bot->replyText($reply_token, $reply_message);
        }
    }
}
