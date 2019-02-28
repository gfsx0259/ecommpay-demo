<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(['action' => 'index.php?r=payment/pay']); ?>

<?= $form->field($model, 'amount', ['inputOptions' => ['id' => 'amount']]) ?>
<?= $form->field($model, 'payment_id', ['inputOptions' => ['id' => 'payment_id']]) ?>

    <div class="form-group">
        <?= Html::submitButton('Pay', ['id' => 'payBtn', 'class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

