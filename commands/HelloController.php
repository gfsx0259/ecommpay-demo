<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use PhpAmqpLib\Connection\AMQPStreamConnection;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class HelloController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @return int Exit code
     * @throws \ErrorException
     */
    public function actionIndex()
    {
        $connection = new AMQPStreamConnection('rabbit', 5672, 'rabbitmq', 'rabbitmq');
        $channel = $connection->channel();
        $channel->queue_declare('hello', false, false, false, false);

        echo " [*] Waiting for messages. To exit press CTRL+C\n";

        $callback = function ($msg) {
            echo ' [x] Received ', $msg->body, "\n";
            sleep($this->countSymbol($msg->body, '.'));
            echo ' [x] Done';
        };

        $channel->basic_consume('hello', '', false, true, false, false, $callback);

        while ($channel->is_consuming()) {
            $channel->wait();
        }

        return ExitCode::OK;
    }

    /**
     * @param string $string
     * @param mixed $symbol
     * @return int
     */
    public function countSymbol($string, $symbol)
    {
        $counted = count_chars($string, 1);
        return $counted[ord($symbol)];
    }

    public function actionPublish($string)
    {
        $client = new \phpcent\Client("http://centrifugo:8000/api");
        $client->setApiKey("eae5e8d2-078d-49c6-9fbc-5a694e38b96a");

        var_dump($client->publish("demo", ["message" => $string]));
    }
}
