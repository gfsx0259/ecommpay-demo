<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
?>

<div class="row">

    <div>
        <p style="background: white; height:300px; width:100%" class="messages"></p>
    </div>

    <div class="col-lg-5">

        <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
        <?= $form->field($model, 'message')->textarea(['rows' => 6])->label() ?>
        <?= $form->field($model, 'recipientId')->label() ?>

        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>