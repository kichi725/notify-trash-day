<?php

namespace App\Http\Controllers\Line;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;

class LineMessengerController extends Controller
{
    public function __construct(
        // private \App\Repositories\LINE\LineMessengerRepositoryInterface $line
        private \App\Services\LINE\ReplyServices $line
    ) {}

    /**
     * @param \Illuminate\Http\Request $request
     * @return boolean
     */
    public function webhook(Request $request): bool
    {
        $this->line->message($request->events);

        return true;
    }

    // メッセージ送信用
    public function message()
    {
        $token = config('services.line.channel_token');
        $secret = config('services.line.messenger_secret');
        // LINEBOTSDKの設定
        $http_client = new CurlHTTPClient($token);
        $bot = new LINEBot($http_client, ['channelSecret' => $secret]);

        $user = \App\Models\User::find(2);

        // LINEユーザーID指定
        // $userId = [config('services.line.user_id')];
        $userId = $user->line_id;

        // メッセージ設定
        $message = 'おはようございます。今日は燃えるゴミの日です。';
        $quick_reply_messages = [
            'type' => 'text',
            'text' => '燃えるゴミの日を登録してください。',
            'quickReply' => [
                'items' => [
                    [
                        'type' => 'action',
                        'action' => [
                            'type' => 'message',
                            'label' => 'Monday',
                            'text' => '月曜日',
                        ],
                        'type' => 'action',
                        'action' => [
                            'type' => 'message',
                            'label' => '火曜日',
                            'text' => 'Tuesday',
                        ],
                    ]
                ],
            ],
        ];

        // メッセージ送信
        // $textMessageBuilder = new TextMessageBuilder($message);

        $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\RawMessageBuilder($quick_reply_messages);
        // $response = $bot->pushMessage($userId, $textMessageBuilder);
        // $response = $bot->multicast($userId, $textMessageBuilder);
        $response = $bot->replyMessage($userId, $textMessageBuilder);

        info('response', (array)$response);
        dd(
            $token,
            $secret,
            $userId,
            $textMessageBuilder,
            $response
        );
    }
}
