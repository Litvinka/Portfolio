<?php
	use yii\helpers\Html;
	use yii\helpers\Url;
?>

<div class="user_info">
	<div class="banner-info">
		<div class="col-md-3">
			<figure class="photo_user">
				<img src="<?=Html::encode($model->photo)?>">
			</figure>
		</div>
		<div class="col-md-9">
			<?=Html::encode($model->surname)?> <?=Html::encode($model->name)?> <?=Html::encode($model->patronumic)?>
			<dl class="user_info_about">
				<dt class="col-md-5">Email:</dt>
				<dd class="col-md-7"><?=Html::encode($model->email)?></dd>
				<dt class="col-md-5">Город:</dt>
				<dd class="col-md-7"><?=Html::encode($model->city->name)?></dd>
				<dt class="col-md-5">Дата рождения:</dt>
				<dd class="col-md-7"><?=Html::encode($model->bithday)?></dd>
				<?php if(Html::encode($model->phone)){?>
					<dt class="col-md-5">Телефон:</dt>
					<dd class="col-md-7"><?=Html::encode($model->phone)?></dd>
				<?php }?>
				<?php if(Html::encode($model->about)){?>
					<dt class="col-md-5">О себе:</dt>
					<dd class="col-md-7"><?=Html::encode($model->about)?></dd>
				<?php }?>
			</dl>
		</div>
		<a href="<?=Url::to(['users/edit', 'id' => $model->id])?>" class="edit-info">Редактировать</a>
	</div>
</div>


<?php 
	$i=0;
	foreach ($profession as $key => $value) { 
?>

	<div class="profession-info <?php echo (($i%2) == 0) ? "left-block" : "right-block"; ?>">
		<div class="profession-block">
			<figure class="profession-photo">
				<figcaption><?=Html::encode($value->name)?></figcaption>
				<img src="<?=Html::encode($value->main_photo)?>">
			</figure>
			<a href="<?=Url::to(['profession/view','id'=>$value->id])?>" class="show-profession">Просмотреть</a>
		</div>
	</div>

<?php
	$i++;
 } ?>


	<a href="<?=Url::to(['profession/create'])?>" class="btn btn-success">Добавить род деятельности</a>



<div class="end-user-info">

</div>