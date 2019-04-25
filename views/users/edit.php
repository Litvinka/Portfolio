<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

?>
<div class="container">
    <h1><?=Yii::$app->view->title?></h1>

    <?php $form=ActiveForm::begin(['id'=>'add-info-user','options' => ['enctype' => 'multipart/form-data']]); ?>
        <?=$form->field($model,'surname')?>
        <?=$form->field($model,'name')?>
        <?=$form->field($model,'patronumic')?>
        <?=$form->field($model,'gender_id')->dropDownList($model->AllGender(), 
            array('prompt'=>'--Выберите пол--')) ?>
        <?=$form->field($model,'city_id')->dropDownList($model->AllCity(), 
            array('prompt'=>'--Выберите город--')) ?>
        <?=$form->field($model,'bithday')->widget(DatePicker::classname(), [
            'type' => DatePicker::TYPE_COMPONENT_PREPEND,
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'dd.mm.yyyy'
            ]
        ])?>
        <?=$form->field($model,'phone')?>
        <?=$form->field($model,'image')->fileInput(['accept' => 'image/*'])?>
        <?=$form->field($model,'about')->textarea(['rows' => '4']) ?>

        <?=Html::submitButton('Сохранить',['class'=>'btn btn-primary'])?>

    <?php ActiveForm::end(); ?>
</div>
