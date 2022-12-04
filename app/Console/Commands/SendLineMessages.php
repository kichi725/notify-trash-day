<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;

class SendLineMessages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'line:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'LINEメッセージを送信するコマンド';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $token = config('services.line.channel_token');
        $secret = config('services.line.messenger_secret');

        // LINEBOTSDKの設定
        $http_client = new CurlHTTPClient($token);
        $bot = new LINEBot($http_client, ['channelSecret' => $secret]);

        $user = \App\Models\User::find(2);

        // LINEユーザーID指定
        $userId = [$user->line_id];

        // メッセージ設定
        $message = 'おはようございます。今日は燃えるゴミの日です。';

        // メッセージ送信（マルチキャスト）
        $textMessageBuilder = new TextMessageBuilder($message);
        $response = $bot->multicast($userId, $textMessageBuilder);

        return Command::SUCCESS;
    }
}
