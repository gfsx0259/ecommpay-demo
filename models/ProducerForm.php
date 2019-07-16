<?php

namespace app\models;

use yii\base\Model;

class ProducerForm extends Model
{
    public $order;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['order'], 'required'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'order' => 'Текст заказа',
        ];
    }
}
