<?php

$session = Yii::$app->session;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

$this->title=Html::encode($model->name);
$session['br_user_elsement']=['label'=>$this->title, 'url'=>['elements/view','id'=>$model->id]];
$this->params['breadcrumbs'][] = $session['br_user_name'];
$this->params['breadcrumbs'][] = $session['br_user_profession'];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="details-prof">

    <div class="details-prof-photos" >
        <div class="prof-l-img" style="background-image:url(<?=Html::encode($model->main_photo)?>)"></div>
        <div class="prof-s-img"></div>
    </div>
    
    <div class="details-prof-about">
        <h2><?=HTML::encode($model->name)?></h2>
        <div>
            <?php echo htmlspecialchars_decode($model->about); ?>
        </div>
    </div>

</div>