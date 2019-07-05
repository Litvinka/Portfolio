<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">

    <?php $form=ActiveForm::begin(['id'=>'add-activity','options' => ['enctype' => 'multipart/form-data']]);  ?>
    <h2><?=Yii::$app->view->title?></h2>
    <?=$form->field($model, 'user_id', ['options' => ['tag' => false], 'template' => '{input}'])->hiddenInput()?>
    <?=$form->field($model,'name')?>
    <?=$form->field($model,'skills')->textarea(['rows' => '4']) ?>
    <?=$form->field($model,'experience_id')->dropDownList($model->allExperience(), 
            array('prompt'=>'--Выберите опыт работы--')) ?>
    <?=$form->field($model,'image')->fileInput(['accept' => 'image/*'])?>
    <?=$form->field($model,'about')->textarea(['rows' => '4']) ?>
    <?=$form->field($model,'visibility_id')->dropDownList($model->allVisibility(), 
            array('prompt'=>'--Выберите видимость--')) ?>
    <div class="div-form-button">
    <?=Html::submitButton('Добавить',['class'=>'form-button'])?>
    </div>

    <?php ActiveForm::end(); ?>
</div>