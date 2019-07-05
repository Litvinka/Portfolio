<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
?>

<div class="one-prof" style="background-image:url(<?=Html::encode($model->main_photo)?>)">
    <div class="block-on-background"></div>
    <h4><?=Html::encode($model->name)?></h4>
    <a href="<?=Url::to(['elements/view','id'=>$model->id])?>" class="show-profession"><img src="/portfolio/web/files/right.png"></a>
</div> 