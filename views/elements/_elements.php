<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
?>

<div>
    <img class="img-elem" src="<?=$model->link?>">
    <?php if(!Yii::$app->user->isGuest && Yii::$app->user->identity->id==$model->element->profession->user_id){ ?>
    <img class="del-elem" src="/web/files/delete.png" onclick="delete_photo(<?=$model->id?>)">
    <?php } ?>
</div> 