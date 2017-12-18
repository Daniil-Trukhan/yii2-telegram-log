Telegram Log
============
Telegram Log

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist wildan99/yii2-telegram-log "*"
```

or add

```
"wildan99/yii2-telegram-log": "*"
```

to the require section of your `composer.json` file.


Usage
-----
```
'log' => [
    'targets' => [
        [
            'class' => 'wildan99\yii2\log\TelegramTarget',
            'levels' => ['error'],
            'botToken' => '123456:abcde', // bot token secret key
            'chatId' => '123456', // chat id or channel username with @ like 12345 or @channel
        ],
    ],
],
```