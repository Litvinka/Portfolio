<?php

$session = Yii::$app->session;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

$this->params['breadcrumbs'][] = $session['br_user_name'];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">

    <?php $form=ActiveForm::begin(['id'=>'add-info-user','options' => ['enctype' => 'multipart/form-data']]); ?>
        <h2><?=Yii::$app->view->title?></h2>
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
        <?=$form->field($model,'photo')->hiddenInput()->label(false)?>
        <label class="control-label" for="user-image">Фото</label>
        <?php if($model->photo){?>
        <div class="form-edit-photo">
            <img src="<?=$model->photo?>"?>
        </div>
        <?php } ?>
        <?=$form->field($model,'image')->fileInput(['accept' => 'image/*'])->label(false)?>
        <?=$form->field($model,'about')->textarea(['rows' => '4']) ?>
        <div class="div-form-button">
        <?=Html::submitButton('Сохранить',['class'=>'form-button'])?>
        </div>

    <?php ActiveForm::end(); ?>
</div>
