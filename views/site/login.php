<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Вход';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',]); ?>

        <h2><?= Html::encode($this->title) ?></h2>
    
        <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe')->checkbox() ?>

        <div class="div-form-button">
                <?= Html::submitButton('Войти', ['class' => 'form-button', 'name' => 'login-button']) ?>
        </div>

    <?php ActiveForm::end(); ?>


</div>
