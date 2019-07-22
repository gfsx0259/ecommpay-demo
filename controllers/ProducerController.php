<?php

namespace app\controllers;

use app\models\ProducerForm;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class ProducerController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index', ['model' => new ProducerForm()]);
    }

    public function actionSend()
    {
        $producerForm = new ProducerForm();
        $producerForm->load(\Yii::$app->request->post());

        $connection = new AMQPStreamConnection('rabbit', 5672, 'rabbitmq', 'rabbitmq');
        $channel = $connection->channel();
        $channel->queue_declare('hello', false, false, false, false);
        $msg = new AMQPMessage($producerForm->order);
        $channel->basic_publish($msg, '', 'hello');
        $channel->close();
        try {
            $connection->close();
        } catch (\Exception $e) {
        }
        $this->redirect(['producer/index']);

    }
}
