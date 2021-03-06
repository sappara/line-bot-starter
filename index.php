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
    // $bot->replyText($event->getReplyToken(), 'TextMessage');
    // 
    // テキストを返信、その２
    // replyTextMessage($bot, $event->getReplyToken(), 'こんにちは');
    // 
    // 画像を返信
    // replyImageMessage($bot, $event->getReplyToken(), 'https://' . $_SERVER['HTTP_HOST'] . '/imgs/original.jpg', 'https://' . $_SERVER['HTTP_HOST'] . '/imgs/preview.jpg');
    // 
    // 位置情報を返信
    // replyLocationMessage($bot, $event->getReplyToken(), 'LINEは', '東京都渋谷区渋谷2-21-1 ヒカリエ27階です', 35.659025, 139.703473);
    // 
    // スタンプを返信
    // replyStickerMessage($bot, $event->getReplyToken(), 11537, 52002745);
    // 
    // 動画を返信
    // replyVideoMessage($bot, $event->getReplyToken(),
    // 'https://' . $_SERVER['HTTP_HOST'] . '/videos/sample.mp4',
    // 'https://' . $_SERVER['HTTP_HOST'] . '/videos/sample_preview.jpg');
    // 
    // オーディファイルを返信
    // replyAudioMessage($bot, $event->getReplyToken(), 'https://' . $_SERVER['HTTP_HOST'] . '/audios/sample.m4a', 22000);
    // 
    // 複数のメッセージをまとめて返信
    // replyMultiMessage($bot, $event->getReplyToken(),
    //     new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('５個まとめて'),
    //     new \LINE\LINEBot\MessageBuilder\ImageMessageBuilder('https://' . $_SERVER['HTTP_HOST'] . '/imgs/original.jpg', 'https://' . $_SERVER['HTTP_HOST'] . '/imgs/preview.jpg'),
    //     new \LINE\LINEBot\MessageBuilder\LocationMessageBuilder('LINEも', '東京都渋谷区渋谷2-21-1 ヒカリエ27階よ', 35.659025, 139.703473),
    //     new \LINE\LINEBot\MessageBuilder\StickerMessageBuilder(11539, 52114118),
    //     new \LINE\LINEBot\MessageBuilder\AudioMessageBuilder('https://' . $_SERVER['HTTP_HOST'] . '/audios/sample.m4a', 22000)
    // );
    // 
    // イベントがPostbackEventクラスのインスタンスであれば
    // （下のPostbackEventは画面上見えないから可視化させてみる）
    //   if ($event instanceof \LINE\LINEBot\Event\PostbackEvent) {
    //   // テキストを返信し次のイベントの処理へ
    //   replyTextMessage($bot, $event->getReplyToken(), 'Postback受信「' . $event->getPostbackData() . '」');
    //   continue;
    // }
    // 
    // Buttonsテンプレートメッセージを返信
    // 引数はLINEBot、返信先、代替テキスト、画像URL、タイトル、本文、アクション(可変長引数)
    // replyButtonsTemplate($bot,
    // $event->getReplyToken(),
    // 'お天気お知らせ - 今日は天気予報は晴れです',
    // 'https://' . $_SERVER['HTTP_HOST'] . '/imgs/template.jpg',
    // 'お天気お知らせ',
    // '今日は天気予報は晴れです',
    // // タップ時、テキストをユーザーに発言させるアクション、第二引数が画面に印字される
    // new LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder (
    //   '明日の天気', 'tomorrow'),
    // // タップ時、テキストをBotに送信するアクション(トークには表示されない)
    // new LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder (
    //   '週末の天気', 'weekend'),
    // // タップ時、URLを開くアクション
    // new LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder (
    //   'Webで見る', 'http://google.jp')
    // // ボタン＝アクションは最大４つまで
    // );
    // 
    // Confirmテンプレートメッセージを返信(シンプルにテキストだけ)
    // 引数はLINEBot、返信先、代替テキスト、本文、アクション(可変長引数)
    // replyConfirmTemplate($bot,
    // $event->getReplyToken(),
    // 'Webで詳しく見ますか？',
    // 'Webで詳しく見ますか？',
    // new LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder (
    //   '見る', 'http://google.jp'),
    // new LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder (
    //   '見ない', 'ignore')
    //   // この状態では、ignoreの後に自動返信されて同じconfirmテンプレが投稿されてしまう
    // // ボタン＝アクションは最大２つまで
    // );
    // 
    // Carouselテンプレートメッセージを返信
    // ダイアログの配列
    // $columnArray = array();
    // for($i = 0; $i < 5; $i++) {
    //   // アクションの配列
    //   $actionArray = array();
    //   array_push($actionArray, new LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder (
    //     'ボタン' . $i . '-' . 1, 'c-' . $i . '-' . 1));
    //   array_push($actionArray, new LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder (
    //     'ボタン' . $i . '-' . 2, 'c-' . $i . '-' . 2));
    //   array_push($actionArray, new LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder (
    //     'ボタン' . $i . '-' . 3, 'c-' . $i . '-' . 3));
    //   // CarouselColumnTemplateBuilderの引数はタイトル、本文、画像URL、アクションの配列
    //   // 以下の部分が画面に印字される
    //   $column = new \LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselColumnTemplateBuilder (
    //     ($i + 1) . '日後の天気',
    //     '晴れ',
    //     'https://' . $_SERVER['HTTP_HOST'] .  '/imgs/template.jpg',
    //     $actionArray
    //   );
    //   // 配列に追加
    //   array_push($columnArray, $column);
    // }
    // replyCarouselTemplate($bot, $event->getReplyToken(),'今後の天気予報', $columnArray);
    // // ボタン押す→c-1-1など印字される→再び同じカルーセルが自動送信されるの繰り返し
    // // ボタン＝アクションは最大３つまで。Columnは５つまでカールセールできる
    // 
    // ここまではBotからユーザーへの自動返信のためのコード
    // 
    // ここからはユーザーからBotへのアップロード
    // テキストはgetText()で簡単。画像/動画/音声は複雑。
    // 以下は画僧をアップロード→HEROKU上に保存
    // 
    // ユーザーから送信された画像ファイルを取得し、サーバーに保存する
    // イベントがImageMessage型であれば
    // if ($event instanceof \LINE\LINEBot\Event\MessageEvent\ImageMessage) {
    //   // イベントのコンテンツを取得
    //   $content = $bot->getMessageContent($event->getMessageId());
    //   // コンテンツヘッダーを取得
    //   $headers = $content->getHeaders();
    //   // 画像の保存先フォルダ
    //   $directory_path = 'tmp';
    //   // 保存するファイル名
    //   $filename = uniqid();
    //   // コンテンツの種類を取得
    //   $extension = explode('/', $headers['Content-Type'])[1];
    //   // 保存先フォルダが存在しなければ
    //   if(!file_exists($directory_path)) {
    //     // フォルダを作成
    //     if(mkdir($directory_path, 0777, true)) {
    //       // 権限を変更
    //       chmod($directory_path, 0777);
    //     }
    //   }
    //   // 保存先フォルダにコンテンツを保存
    //   file_put_contents($directory_path . '/' . $filename . '.' . $extension, $content->getRawBody());
    //   // 保存したファイルのURLを返信
    //   replyTextMessage($bot, $event->getReplyToken(), 'http://' . $_SERVER['HTTP_HOST'] . '/' . $directory_path. '/' . $filename . '.' . $extension);
    // }
    //
    // ここまでユーザーからのアップロード
    // 
    // 以下は Botからユーザーへの自動返信
    // 
    // ユーザーのプロフィールを取得しメッセージを作成後返信
    $profile = $bot->getProfile($event->getUserId())->getJSONDecodedBody();
    $bot->replyMessage($event->getReplyToken(),
      (new \LINE\LINEBot\MessageBuilder\MultiMessageBuilder())
        ->add(new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('現在のプロフィールです。'))
        ->add(new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('表示名：' . $profile['displayName']))
        ->add(new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('画像URL：' . $profile['pictureUrl']))
        ->add(new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('ステータスメッセージ：' . $profile['statusMessage']))
    );
}


// テキストを返信。引数はLINEBot、返信先、テキスト
function replyTextMessage($bot, $replyToken, $text) {
    // 返信を行いレスポンスを取得
    // TextMessageBuilderの引数はテキスト
    $response = $bot->replyMessage($replyToken, new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($text));
    // レスポンスが異常な場合
    if (!$response->isSucceeded()) {
      // エラー内容を出力
      error_log('Failed! '. $response->getHTTPStatus . ' ' . $response->getRawBody());
    }
  }

// 画像を返信。引数はLINEBot、返信先、画像URL、サムネイルURL
function replyImageMessage($bot, $replyToken, $originalImageUrl, $previewImageUrl) {
    // ImageMessageBuilderの引数は画像URL、サムネイルURL
    $response = $bot->replyMessage($replyToken, new \LINE\LINEBot\MessageBuilder\ImageMessageBuilder($originalImageUrl, $previewImageUrl));
    if (!$response->isSucceeded()) {
      error_log('Failed!'. $response->getHTTPStatus . ' ' . $response->getRawBody());
    }
  }

// 位置情報を返信。引数はLINEBot、返信先、タイトル、住所、
// 緯度、経度
function replyLocationMessage($bot, $replyToken, $title, $address, $lat, $lon) {
    // LocationMessageBuilderの引数はダイアログのタイトル、住所、緯度、経度
    $response = $bot->replyMessage($replyToken, new \LINE\LINEBot\MessageBuilder\LocationMessageBuilder($title, $address, $lat, $lon));
    if (!$response->isSucceeded()) {
      error_log('Failed!'. $response->getHTTPStatus . ' ' . $response->getRawBody());
    }
  }

// スタンプを返信。引数はLINEBot、返信先、
// スタンプのパッケージID、スタンプID
function replyStickerMessage($bot, $replyToken, $packageId, $stickerId) {
    // StickerMessageBuilderの引数はスタンプのパッケージID、スタンプID
    $response = $bot->replyMessage($replyToken, new \LINE\LINEBot\MessageBuilder\StickerMessageBuilder($packageId, $stickerId));
    if (!$response->isSucceeded()) {
    error_log('Failed!'. $response->getHTTPStatus . ' ' . $response->getRawBody());
    }
}

// 動画を返信。引数はLINEBot、返信先、動画URL、サムネイルURL
function replyVideoMessage($bot, $replyToken, $originalContentUrl, $previewImageUrl) {
    // VideoMessageBuilderの引数は動画URL、サムネイルURL
    $response = $bot->replyMessage($replyToken, new \LINE\LINEBot\MessageBuilder\VideoMessageBuilder($originalContentUrl, $previewImageUrl));
    if (!$response->isSucceeded()) {
      error_log('Failed! '. $response->getHTTPStatus . ' ' . $response->getRawBody());
    }
  }

// オーディオファイルを返信。引数はLINEBot、返信先、
// ファイルのURL、ファイルの再生時間
function replyAudioMessage($bot, $replyToken, $originalContentUrl, $audioLength) {
    // AudioMessageBuilderの引数はファイルのURL、ファイルの再生時間
    $response = $bot->replyMessage($replyToken, new \LINE\LINEBot\MessageBuilder\AudioMessageBuilder($originalContentUrl, $audioLength));
    if (!$response->isSucceeded()) {
      error_log('Failed! '. $response->getHTTPStatus . ' ' . $response->getRawBody());
    }
  }

// 複数のメッセージをまとめて返信。引数はLINEBot、
// 返信先、メッセージ(可変長引数)
function replyMultiMessage($bot, $replyToken, ...$msgs) {
    // MultiMessageBuilderをインスタンス化
    $builder = new \LINE\LINEBot\MessageBuilder\MultiMessageBuilder();
    // ビルダーにメッセージを全て追加
    foreach($msgs as $value) {
      $builder->add($value);
    }
    $response = $bot->replyMessage($replyToken, $builder);
    if (!$response->isSucceeded()) {
      error_log('Failed!'. $response->getHTTPStatus . ' ' . $response->getRawBody());
    }
  }

// Buttonsテンプレートを返信。引数はLINEBot、返信先、代替テキスト、
// 画像URL、タイトル、本文、アクション(可変長引数)
function replyButtonsTemplate($bot, $replyToken, $alternativeText, $imageUrl, $title, $text, ...$actions) {
  // アクションを格納する配列
  $actionArray = array();
  // アクションを全て追加
  foreach($actions as $value) {
    array_push($actionArray, $value);
  }
  // TemplateMessageBuilderの引数は代替テキスト、ButtonTemplateBuilder
  $builder = new \LINE\LINEBot\MessageBuilder\TemplateMessageBuilder(
    $alternativeText,
    // ButtonTemplateBuilderの引数はタイトル、本文、画像URL、アクションの配列
    // 画像とタイトルは省略可能、引数にnull
    new \LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder ($title, $text, $imageUrl, $actionArray)
  );
  $response = $bot->replyMessage($replyToken, $builder);
  if (!$response->isSucceeded()) {
    error_log('Failed!'. $response->getHTTPStatus . ' ' . $response->getRawBody());
  }
}

// Confirmテンプレートを返信。引数はLINEBot、返信先、代替テキスト、
// 本文、アクション(可変長引数)
function replyConfirmTemplate($bot, $replyToken, $alternativeText, $text, ...$actions) {
  $actionArray = array();
  foreach($actions as $value) {
    array_push($actionArray, $value);
  }
  $builder = new \LINE\LINEBot\MessageBuilder\TemplateMessageBuilder(
    $alternativeText,
    // Confirmテンプレートの引数はテキスト、アクションの配列
    new \LINE\LINEBot\MessageBuilder\TemplateBuilder\ConfirmTemplateBuilder ($text, $actionArray)
  );
  $response = $bot->replyMessage($replyToken, $builder);
  if (!$response->isSucceeded()) {
    error_log('Failed!'. $response->getHTTPStatus . ' ' . $response->getRawBody());
  }
}

// Carouselテンプレートを返信。引数はLINEBot、返信先、代替テキスト、
// ダイアログの配列
function replyCarouselTemplate($bot, $replyToken, $alternativeText, $columnArray) {
  $builder = new \LINE\LINEBot\MessageBuilder\TemplateMessageBuilder(
  $alternativeText,
  // Carouselテンプレートの引数はダイアログの配列
  new \LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselTemplateBuilder (
   $columnArray)
  );
  $response = $bot->replyMessage($replyToken, $builder);
  if (!$response->isSucceeded()) {
    error_log('Failed!'. $response->getHTTPStatus . ' ' . $response->getRawBody());
  }
}
?>
