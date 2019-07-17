<?php

$session = Yii::$app->session;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\widgets\ActiveForm;

$this->title=Html::encode($model->name);
$session['br_user_elsement']=['label'=>$this->title, 'url'=>['elements/view','id'=>$model->id]];
$this->params['breadcrumbs'][] = $session['br_user_name'];
$this->params['breadcrumbs'][] = $session['br_user_profession'];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="background-modal">
    <div class="modal-window">
        <p>Вы уверены, что хотите удалить элемент?</p>
        <?php $form = ActiveForm::begin(['action' => 'index.php?r=elements/delete','options' => ['method' => 'post']]) ?>
            <input type="hidden" name="id" value="<?=$model->id?>">
            <input type="submit" value="Удалить">
        <?php $form = ActiveForm::end()?>
    </div>
</div>

<div class="details-prof">
    
    <?php if(!Yii::$app->user->isGuest && Yii::$app->user->identity->id==$model->profession->user_id){ ?>
    <div class="element-group-btn">
         <a href="<?=Url::to(['elements/edit','id'=>$model->id])?>"><img src="files/edit.png"></a>
        
         <a href="#" class="delete-btn-a"><img src="files/delete.png"></a>
    </div>
    <?php } ?>
    
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



<?php echo ListView::widget([
        'id' => 'all-elements-photo',
        'dataProvider' => $dataProvider,
        'itemView' => '_elements',
        'itemOptions' => [
            'tag' => false,
        ],
        'summary' => false,
    ]);
?>
