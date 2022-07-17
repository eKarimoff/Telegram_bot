<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Telegram Bot</title>
    
</head>
<body>
<?php

 const TOKEN = '5577926719:AAFMFcfuj2dPQFzE35sAL81XU6Dq8rMAf40';
$update = json_decode(file_get_contents('php://input'),true);
$message = $update['message'];
$from = $message['from'];
$chat = $message['chat'];
$photo = $message['photo'];
$file_id1 = $photo[0]['file_id'];
$file_id2 = $photo[1]['file_id'];
$file_id3 = $photo[2]['file_id'];
$userid = $from['id'];
$chat_id = $chat['id'];
$callback_query= $update['callback_query'];
$chat_id1 = $callback_query['from']['id'];
$chat_id2 = $callback_query['from']['id'];
$chat_id3 = $callback_query['from']['id'];
$text = $message['text'];
$data = $callback_query['data'];
$message_id = $message['message_id'];
$user_full_name = $from['first_name'].' '.$from['last_name'];
$language_code = $from['language_code'] ?: $callback_query['from']['language_code'];

        file_get_contents('https://api.telegram.org/bot'.$token.'/sendmessage?chat_id='.$chat_id.'&text='.$text);

    function bot($method,$data = [],$token = TOKEN){
        $bot = curl_init();
        curl_setopt($bot,CURLOPT_URL,'https://api.telegram.org/bot'.$token.'/'.$method);
        curl_setopt($bot,CURLOPT_POSTFIELDS,$data);
        curl_setopt($bot,CURLOPT_RETURNTRANSFER,true);
        $res = curl_exec($bot);
        return json_decode($res);

    }
    
    // if($text == '/start')
    // {
    //    $obj = bot('getMe');
    //    bot('sendmessage',[
    //     'chat_id'=>$chat_id,
    //     'text'=>'[My site](telegramsmartbot.herokuapp.com),[My Telegram Account](tg://user?id=237068335)',
    //     'parse_mode'=>'Markdown',
    //     'reply_to_message_id'=>$message_id
    //    ]);

    // }
    // if($text == '/hello')
    // {
    //    bot('sendmessage',[
    //     'chat_id'=>$chat_id,
    //     // 'text'=>"<pre>".json_encode($update, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)."</pre>",
    //     'text'=>'Assalomu Alaykum <b>'.$user_full_name.'</b>',
    //     'parse_mode'=>'html',
    //    ]);

    // }
    if($text == 'salom'){
       bot('sendmessage',[
        $hello = ['Assalomu Alaykum','Qales','Hush kelibsiz','Nima gaplar','Bormisiz e akam'],
        $rand_text = array_rand($hello),
        'chat_id'=>$chat_id,
        // 'text'=>"<pre>".json_encode($update, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)."</pre>",
        'text'=>'<b>'.$hello[$rand_text].' '.$user_full_name.'</b>',
        'parse_mode'=>'html',
       ]);

    }
    if($text == '/start' || $text == '/relang'){
        $keyboard = json_encode(
            [ 
            'inline_keyboard'=>[
            [
                ['text' =>'Kirilcha','callback_data'=>'kiril'],
                ['text' =>'Lotin','callback_data'=>'lotin'],
            ]
            ],
            'resize_keyboard'=>true,
        ]);
        bot('sendMessage',[
            'chat_id'=>$chat_id,
            'text'=>'Alfabit turini tanlang:',

            'reply_markup'=>$keyboard
        ]);
            
     }
     if($text == '/clear'){
        $remove = json_encode(['remove_keyboard'=>true]);
        $force = json_encode(['force_reply'=>true]);
        bot('sendMessage',[
            'chat_id'=>$chat_id,
            'text'=>'Deleted Successfully!',
            'reply_markup'=>$remove
        ]);
            
     }
     if($text == '/inline'){
        $inline = json_encode([

                'inline_keyboard'=> [
                [
                    ['text' => 'Kirilcha','callback_data'=>'kiril'],
                    ['text' => 'Lotincha','callback_data'=>'lotin'],
                ],
                [
                    ['text' => 'F.I.O','callback_data'=>'fio'],

                ]
                    ],
          ]);
        bot('sendMessage',[
            'chat_id'=>$chat_id,
            'text'=>'Alfabit turini tanlang:',
            'reply_markup'=>$inline
        ]);
            
     }
    //  bot('sendMessage',[
    //     'chat_id'=>$chat_id,
    //     'text'=>$language_code
    //  ]);
     if($data == 'kiril'){
        bot('sendMessage',[
            'chat_id'=>$chat_id1,
            'text'=>'Siz Kirilchani tanladingiz!  Agar alfabitni o\'zgartimoqchi bo\'lsangiz /relang ni bosing'."\n\nDavom ettirish uchun /fio tugmasini bosing",
        ]);
     }
     if($data == 'lotin'){
        bot('sendMessage',[
            'chat_id'=>$chat_id2,
            'text'=>'Siz Lotinchani tanladingiz! Agar alfabitni o\'zgartimoqchi bo\'lsangiz /relang ni bosing'."\n\nDavom ettirish uchun /fio tugmasini bosing",
        ]);
     }
     if($data == 'fio'){
        bot('sendMessage',[
            'chat_id'=>$chat_id3,
            'text'=>'Ism Familiya Ochistvani kiriting:',
                      
        ]);
     }
 
     //-------------------------------------------------------------------------------------------------------------------------------------//
     bot('sendPhoto',[
         'chat_id'=>$chat_id,
         'photo'=>$file_id3
     ]);

if($text=='cat')
{
    $send = bot('sendPhoto',[
        'chat_id'=>$chat_id,
        'photo'=>'https://images.theconversation.com/files/457052/original/file-20220408-15-pl446k.jpg?ixlib=rb-1.1.0&q=45&auto=format&w=1000&fit=clip'
    ]);
    $error = $send->description;
    if(!empty($error)){
        bot('sendMessage',[
            'chat_id'=>$chat_id,
            'text'=>$error,
        ]);
    }
   
}

    
?>

