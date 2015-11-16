<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title='注册';
//$this->params['breadcrumbs'][] = 'signup';
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <?= $form->field($model, 'username' ) ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'authkey')->passwordInput() ?>
                <div class="form-group">
                    <?= Html::submitButton('注册', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>