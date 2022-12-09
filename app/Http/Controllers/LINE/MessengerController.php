<?php

declare(strict_types=1);

namespace App\Http\Controllers\LINE;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// use LINE\LINEBot;
// use LINE\LINEBot\HTTPClient\CurlHTTPClient;
// use LINE\LINEBot\MessageBuilder\TextMessageBuilder;

class MessengerController extends Controller
{
    public function __construct(private \App\Services\LINE\MessengerServices $service)
    {
    }

    /**
     * メッセージ受信
     *
     * @param \Illuminate\Http\Request $request
     * @return boolean
     */
    public function webhook(Request $request): bool
    {
        info('request', $request->all());

        $this->service->webhook($request->events[0]);

        return true;
    }

    // events [
    //     {
    //         "type":"message",
    //         "message":{
    //             "type":"text",
    //             "id":"17242691334965",
    //             "text":"土曜日"
    //         },
    //         "webhookEventId":"01GKH3VRW9EYFVW6EW0KNSKZ9G",
    //         "deliveryContext":{
    //             "isRedelivery":false
    //         },
    //         "timestamp":1670243017361,
    //         "source":{
    //             "type":"user",
    //             "userId":"Uf3fca18d1470f52ad59bf7e2bdcef02e"
    //         },
    //         "replyToken":"928da2f3d5d34acea3311ab2b562d6cd",
    //         "mode":"active"
    //     }
    // ]

    // メッセージ送信用
    // public function message(): void
    // {
    //     $token  = config('services.line.channel_token');
    //     $secret = config('services.line.messenger_secret');
    //     // LINEBOTSDKの設定
    //     $http_client = new CurlHTTPClient($token);
    //     $bot         = new LINEBot($http_client, ['channelSecret' => $secret]);

    //     $user = \App\Models\User::find(2);

    //     // LINEユーザーID指定
    //     // $userId = [config('services.line.user_id')];
    //     $userId = $user->line_id;

    //     // メッセージ設定
    //     $message              = 'おはようございます。今日は燃えるゴミの日です。';
    //     $quick_reply_messages = [
    //         'type'       => 'text',
    //         'text'       => '燃えるゴミの日を登録してください。',
    //         'quickReply' => [
    //             'items' => [
    //                 [
    //                     'type'   => 'action',
    //                     'action' => [
    //                         'type'  => 'message',
    //                         'label' => 'Monday',
    //                         'text'  => '月曜日',
    //                     ],
    //                     'type'   => 'action',
    //                     'action' => [
    //                         'type'  => 'message',
    //                         'label' => '火曜日',
    //                         'text'  => 'Tuesday',
    //                     ],
    //                 ]
    //             ],
    //         ],
    //     ];

    //     // メッセージ送信
    //     // $textMessageBuilder = new TextMessageBuilder($message);

    //     $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\RawMessageBuilder($quick_reply_messages);
    //     // $response = $bot->pushMessage($userId, $textMessageBuilder);
    //     // $response = $bot->multicast($userId, $textMessageBuilder);
    //     $response = $bot->replyMessage($userId, $textMessageBuilder);

    //     info('response', (array)$response);
    //     dd(
    //         $token,
    //         $secret,
    //         $userId,
    //         $textMessageBuilder,
    //         $response
    //     );
    // }
}
