<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class PaymentForm extends Model
{
    public $amount;
    public $payment_id;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['amount', 'payment_id'], 'required'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'amount' => 'Сумма',
            'payment_id' => 'Идентификатор заказа мерчанта',
        ];
    }
}
