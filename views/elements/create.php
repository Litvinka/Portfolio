<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

Yii::$app->view->title="Добавление элемента";
?>

<div class="container">
    
    <h1><?=Yii::$app->view->title?></h1>

    <?php $form=ActiveForm::begin(['id'=>'add-element','options'=>['enctype'=>'multipart/form-data']]);  ?>

    <?=$form->field($model, 'profession_id', ['options' => ['tag' => false], 'template' => '{input}'])->hiddenInput()?>
    <?=$form->field($model,'name')?>
    <?=$form->field($model,'image')->fileInput(['accept'=>'image/*'])?>
    <?=$form->field($model,'about')->textarea(['rows'=>4])?>

    <?=Html::submitButton('Добавить',['class'=>'btn btn-primary'])?>

    <?php ActiveForm::end(); ?>

</div>