<?php

namespace app\controllers;

use app\models\PaymentForm;
use ecommpay\Gate;
use ecommpay\Payment;

class PaymentModalController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index', ['model' => new PaymentForm()]);
    }

    const MERCHANT_SECRET_KEY = 'test';
    const MERCHANT_PROJECT_ID = '402';


    public function actionPay()
    {
        $paymentForm = new PaymentForm();
        $paymentForm->load(\Yii::$app->request->post());

        /**
         * secretKey должен совпадать с значением, заданным для мерчанта на стенде (см Processing.site.secret_key фильтруем по id, это project_id)
         */
        $gate = new Gate(self::MERCHANT_SECRET_KEY);
        $payment = new Payment(self::MERCHANT_PROJECT_ID);

        $successPageUrl = 'http://localhost:8080/index.php?r=payment/callback';

        $payment
            ->setPaymentAmount($paymentForm->amount)
            ->setPaymentCurrency('RUB')
            // Уникальный id заказа на стороне мерчанта, который мы ему вернём
            ->setPaymentId($paymentForm->payment_id)
            // Ссылка на кнопке "вернуть на сайт" в случае успешной оплаты
            ->setMerchantSuccessUrl($successPageUrl)
            // Ссылка на которую будет совершён редирект (если установлена) в случае успешной оплаты
            ->setRedirectSuccessUrl($successPageUrl);

        $paymentPageUrl = $gate->getPurchasePaymentPageUrl($payment);

        $this->redirect($paymentPageUrl);
    }

    public function actionCallback()
    {
        die('Заказ успешно оплачен №' . \Yii::$app->request->get('payment_id'));
    }

    public function actionNotify()
    {
        die("200 OK");
    }
}
