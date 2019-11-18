<?php

namespace app\models;

use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ChatForm extends Model
{
    public $message;

    public $recipientId;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['message'], 'safe'],
            [['recipientId'], 'integer'],
        ];
    }
}
