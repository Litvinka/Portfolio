<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="container">
    <h1><?=Yii::$app->view->title?></h1>

    <?php $form=ActiveForm::begin(['id'=>'add-activity','options' => ['enctype' => 'multipart/form-data']]);  ?>

    <?=$form->field($model, 'user_id', ['options' => ['tag' => false], 'template' => '{input}'])->hiddenInput()?>
    <?=$form->field($model,'name')?>
    <?=$form->field($model,'skills')->textarea(['rows' => '4']) ?>
    <?=$form->field($model,'experience_id')->dropDownList($model->allExperience(), 
            array('prompt'=>'--Выберите опыт работы--')) ?>
    <?=$form->field($model,'image')->fileInput(['accept' => 'image/*'])?>
    <?=$form->field($model,'about')->textarea(['rows' => '4']) ?>
    <?=$form->field($model,'visibility_id')->dropDownList($model->allVisibility(), 
            array('prompt'=>'--Выберите видимость--')) ?>
    <?=Html::submitButton('Добавить',['class'=>'btn btn-primary'])?>

    <?php ActiveForm::end(); ?>
</div>