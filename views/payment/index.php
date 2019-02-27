<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin(['action' => 'index.php?r=payment/pay']); ?>

<?= $form->field($model, 'amount') ?>
<?= $form->field($model, 'payment_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>