<?php
declare(strict_types=1);

namespace wildan99\yii2\log;

use yii\base\InvalidConfigException;
use yii\log\Logger;
use yii\log\Target;

/**
 * Class TelegramTarget
 *
 * @package app\components
 */
class TelegramTarget extends Target
{
    /**
     * Yii 2.0 Telegram Log Target
     * TelegramTarget sends selected log messages to the specified telegram chats or channels
     *
     * 'log' => [
     *     'targets' => [
     *         [
     *             'class' => 'wildan99\yii2\log\TelegramTarget',
     *             'levels' => ['error'],
     *             'botToken' => '123456:abcde', // bot token secret key
     *             'chatId' => '123456', // chat id or channel username with @ like 12345 or @channel
     *         ],
     *     ],
     * ],
     *
     * [Telegram bot token](https://core.telegram.org/bots#botfather)
     * @var string
     */
    public $botToken;
    /**
     * Destination chat id or channel username
     * @var int|string
     */
    public $chatId;

    /**
     * @var array
     */
    public $enableNotification = [
        Logger::LEVEL_ERROR => true,
        Logger::LEVEL_WARNING => false,
        Logger::LEVEL_INFO => false,
    ];

    /**
     * Check required properties
     * @throws InvalidConfigException
     */
    public function init()
    {
        parent::init();
        foreach (['botToken', 'chatId'] as $property) {
            if ($this->$property === null) {
                throw new InvalidConfigException(self::className() . "::\$$property property must be set");
            }
        }
    }

    /**
     * Exports log [[messages]] to a specific destination.
     * Child classes must implement this method.
     */
    public function export()
    {
        $bot = new TelegramBot(['token' => $this->botToken]);
        $messages = array_map([$this, 'formatMessage'], $this->messages);
        foreach ($messages as $message) {
            $bot->sendMessage($this->chatId, $message);
        }
    }
}
