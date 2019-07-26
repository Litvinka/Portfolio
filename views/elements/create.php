<?php

$session = Yii::$app->session;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

$this->params['breadcrumbs'][] = $session['br_user_name'];
$this->params['breadcrumbs'][] = $session['br_user_profession'];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">

    <?php $form=ActiveForm::begin(['id'=>'add-element','options'=>['enctype'=>'multipart/form-data']]);  ?>
    
    <h2><?=Yii::$app->view->title?></h2>
    
    <?=$form->field($model, 'profession_id', ['options' => ['tag' => false], 'template' => '{input}'])->hiddenInput()?>
    <?=$form->field($model,'name')?>
    <label class="control-label" for="elements-image">Картинка</label>
    <?php if($model->main_photo){?>
        <div class="form-edit-photo">
            <img src="<?=$model->main_photo?>"?>
        </div>
    <?php } ?>
    <?=$form->field($model,'image')->fileInput(['accept'=>'image/*'])->label(false)?>
    <label class="control-label" for="elements-image">Добавить дополнительные фото</label>
    <?=$form->field($model,'photos[]')->fileInput(['accept'=>'image/*','multiple' => true])->label(false)?>
    <label class="control-label" for="tags">Ключевые слова (через запятую)</label>
    <?=$form->field($model,'tags')->textInput(['value' => $model->getTags()])->label(false)?>
    <?=$form->field($model,'about')->widget(CKEditor::className(), [
        'options' => ['rows' => 8],
        'preset' => 'basic'
    ])?>

    <div class="div-form-button">
        <?=Html::submitButton('Сохранить',['class'=>'form-button'])?>
    </div>

    <?php ActiveForm::end(); ?> 

</div>