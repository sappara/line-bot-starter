<?php
// echo "Hello World!";

// Composerでインストールしたライブラリを一括読み込み
require_once __DIR__ . '/vendor/autoload.php';

// POSTメソッドで渡される値を取得、表示
// $inputString = file_get_contents('php://input');
// error_log($inputString);// ログを出力する
// ターミナルでログ確認 heroku logs --app ヘロクのプロジェクト名 --tail -s app
// テスト送信ok json形式で受信確認ok

// アクセストークンを使いCurlHTTPClientをインスタンス化
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(getenv('CHANNEL_ACCESS_TOKEN'));
// CurlHTTPClientとシークレットを使いLINEBotをインスタンス化
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => getenv('CHANNEL_SECRET')]);
// LINE Messaging APIがリクエストに付与した署名を取得
$signature = $_SERVER['HTTP_' . \LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];

// 署名が正当かチェック。正当であればリクエストをパースし配列へ
$events = $bot->parseEventRequest(file_get_contents('php://input'), $signature);
// 配列に格納された各イベントをループで処理
foreach ($events as $event) {
    // テキストを返信
    $bot->replyText($event->getReplyToken(), 'TextMessage');
}

?>
