<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title='Регистрация';
$this->params['breadcrumbs'][]=$this->title;
?>
<div class="site-signup">
    <div class="row">
    	<div class="col-lg-5">
    		<?php $form=ActiveForm::begin(['id'=>'form-signup']); ?>
            <h2><?=Html::encode($this->title)?></h2>
    		<?=$form->field($model,'email')->textInput(['autofocus'=>true]) ?>
    		<?=$form->field($model,'password')->passwordInput() ?>
    		<div class="div-form-button">
    			<?=Html::submitButton('Зарегистрироваться', ['class'=>'form-button', 'name'=>'signup-button']) ?>
    		</div>
    		<?php ActiveForm::end(); ?>
    	</div>
    </div>
</div>

