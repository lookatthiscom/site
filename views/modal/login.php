<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
?>
<div class="box-modal custom-arctic" id="loginModal">
    <div class="box-modal_close arcticmodal-close"><?=Yii::t('app','Close');?></div>
    <div class="login-place">
        <?php $form = ActiveForm::begin([
            'id' => 'modal-login-form',
            'action' => Url::toRoute(['site/login']),
            'options' => ['class' => 'form-horizontal'],
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-md-7\">{input}</div>\n<div class=\"col-md-8\">{error}</div>",
                'labelOptions' => ['class' => 'col-md-4 control-label'],
            ],
        ]); ?>

        <?= $form->field($model, 'username') ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe', [
            'template' => "<div class=\"col-md-offset-3 col-md-3\">{input}</div>\n<div class=\"col-md-8\">{error}</div>",
        ])->checkbox() ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Login', ['id' => 'login-btn', 'class' => 'btn btn-primary col-md-6', 'name' => 'login-button']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
    <div class="registration-place">
        <?php $form = ActiveForm::begin([
            'id' => 'modal-registration-form',
            'action' => Url::toRoute(['site/registration']),
            'options' => ['class' => 'form-horizontal'],
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-md-7\">{input}</div>\n<div class=\"col-md-8\">{error}</div>",
                'labelOptions' => ['class' => 'col-md-4 control-label'],
            ],
        ]); ?>

        <?= $form->field($registration, 'username') ?>

        <?= $form->field($registration, 'email') ?>

        <?= $form->field($registration, 'password')->passwordInput() ?>

        <?= $form->field($registration, 'rememberMe', [
            'template' => "<div class=\"col-md-offset-1 col-md-3\">{input}</div>\n<div class=\"col-md-8\">{error}</div>",
        ])->checkbox() ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Sign up', ['id' => 'sign-up-btn', 'class' => 'btn btn-success col-md-6', 'name' => 'login-button']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>