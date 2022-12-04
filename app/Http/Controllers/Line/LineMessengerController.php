<?php

namespace App\Http\Controllers\Line;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;

class LineMessengerController extends Controller
{
    public function webhook(Request $request)
    {
        // LINEから送られた内容を$inputsに代入
        $inputs=$request->all();

        info('request', $inputs);

        // // そこからtypeをとりだし、$message_typeに代入
        // $message_type=$inputs['events'][0]['type'];

        // // メッセージが送られた場合、$message_typeは'message'となる。その場合処理実行。
        // if($message_type=='message') {

        //     // replyTokenを取得
        //     $reply_token=$inputs['events'][0]['replyToken'];

        //     // LINEBOTSDKの設定
        //     $http_client = new CurlHTTPClient(config('services.line.channel_token'));
        //     $bot = new LINEBot($http_client, ['channelSecret' => config('services.line.messenger_secret')]);

        //     // 送信するメッセージの設定
        //     $reply_message='メッセージありがとうございます';

        //     // ユーザーにメッセージを返す
        //     $reply=$bot->replyText($reply_token, $reply_message);

        //     return 'ok';
        // }
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
        $userId = [$user->line_id];

        // メッセージ設定
        $message = 'おはようございます。今日は燃えるゴミの日です。';

        // メッセージ送信
        $textMessageBuilder = new TextMessageBuilder($message);
        // $response = $bot->pushMessage($userId, $textMessageBuilder);
        $response = $bot->multicast($userId, $textMessageBuilder);
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
