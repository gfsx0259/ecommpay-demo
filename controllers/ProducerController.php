<?php

namespace app\controllers;

use app\models\ProducerForm;

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
        var_dump($producerForm->order);
        die;
    }
}
