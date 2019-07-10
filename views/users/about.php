<?php

$session = Yii::$app->session;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title=$model->surname." ".$model->name;
$session['br_user_name']=$model->SetBreadcrumbs();
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user_info">
	<div class="banner-info">
		<div class="photo_user" style="background-image:url(<?=Html::encode($model->photo)?>)"></div>
		<div>
			<h3><?=Html::encode($model->surname)?> <?=Html::encode($model->name)?> <?=Html::encode($model->patronumic)?></h3>
			<dl class="user_info_about">
				<div><dt>Email:</dt><dd><?=Html::encode($model->email)?></dd></div>
				<div><dt>Город:</dt><dd><?=Html::encode($model->city->name)?></dd></div>
				<?php if(Html::encode($model->phone)){?>
				    <div><dt>Телефон:</dt><dd><?=Html::encode($model->phone)?></dd></div>
				<?php }?>
				<?php if(Html::encode($model->about)){?>
					<div><dt>О себе:</dt><dd><?=htmlspecialchars_decode($model->about)?></dd></div>
				<?php }?>
			</dl>
		</div>
        
        <?php if(!Yii::$app->user->isGuest && Yii::$app->user->identity->id==$model->id){ ?>
		<a href="<?=Url::to(['users/edit', 'id' => $model->id])?>" class="edit-info">Редактировать</a>
        <?php } ?>
        
	</div>
</div>


<div class="all-profession">
    <h2>Виды деятельности</h2>

    <div class="profession-info">
    <?php 
        $i=0;
        foreach ($profession as $key => $value) { 
    ?>
		<div class="profession-block" style="background-image:url(<?=Html::encode($value->main_photo)?>)">
            <div class="block-on-background"></div>
            <h4><?=Html::encode($value->name)?></h4>
            <h5></h5>
			<a href="<?=Url::to(['profession/view','id'=>$value->id])?>" class="show-profession"><img src="/portfolio/web/files/right.png"></a>
		</div>
<?php
	$i++;
 } ?>
    </div>

    <?php if(!Yii::$app->user->isGuest && Yii::$app->user->identity->id==$model->id){ ?>
    <div>
        <a href="<?=Url::to(['profession/create'])?>" class="btn-add"><img src="/portfolio/web/files/plus.png"></a>
    </div>
    <?php } ?>
    
</div>
	

