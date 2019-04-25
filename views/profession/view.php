<?php

use yii\helpers\Html;
use yii\helpers\Url;

Yii::$app->view->title=Html::encode($model->name);
?>

<div class="row profession">
    <div class="profession-details col-md-9">
        <h2><?=Yii::$app->view->title?></h2>
        <div class="row">
            <div class="col-md-4">
                <figure class="main-photo">
                    <img src="<?=Html::encode($model->main_photo) ?>">
                </figure>
            </div>
            <div class="col-md-8">
                <dl>
                    <?php if(!empty($model->skills)){ ?>
                        <dt>Навыки:</dt>
                        <dd><?=Html::encode($model->skills)?></dd>
                    <?php } 
                    if(!empty($model->experience_id)){
                    ?>
                        <dt>Опыт:</dt>
                        <dd><?=Html::encode($model->experience_id)?></dd>
                    <?php }
                    if(!empty($model->about)){
                    ?>
                        <dt>Описание:</dt>
                        <dd><?=Html::encode($model->about)?></dd>
                    <?php } ?>
                </dl>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <a href="<?=Url::to(['elements/create','profession_id'=>$model->id])?>">Добавить элемент</a>
    </div>
    
</div>

<div class="all-profession-elements">
    <?php
        foreach($elements as $key=>$value){
    ?>
            <div class="col-md-4">
                <?=Html::encode($value->name)?>
                <img src="<?=Html::encode($value->main_photo)?>">
                <a href="<?=Url::to(['elements/view','id'=>$value->id])?>">Посмотреть</a>
            </div> 
    <?php        
        }
    ?>
</div>