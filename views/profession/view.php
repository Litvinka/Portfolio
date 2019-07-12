<?php

$session = Yii::$app->session;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

$this->title=Html::encode($model->name);
$session['br_user_profession'] = $model->SetBreadcrumbs();
$this->params['breadcrumbs'][] = $session['br_user_name'];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="profession">
    <div class="prof-header">
        <div class="prof-photo" style="background-image:url(<?=Html::encode($model->main_photo)?>)"></div>
        <div class="prof-about">
                <h3><?=Yii::$app->view->title?></h3>
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
    
    <?php if(!Yii::$app->user->isGuest && Yii::$app->user->identity->id==$model->user_id){ ?>
    <div class="prof-button-add">
        <a href="<?=Url::to(['elements/create','profession_id'=>$model->id])?>" class="btn-add"><img src="files/plus.png"></a>
    </div>
    <?php } ?>
    
</div>

<div class="profession-list-block">
    <h2>Работы</h2>

    <?php echo ListView::widget([
            'id' => 'all-profession-elements',
            'dataProvider' => $dataProvider,
            'itemView' => '_elements',
            'itemOptions' => [
                'tag' => false,
            ],
            'summary' => false,
        ]);
    ?>
    
    <?php if(!Yii::$app->user->isGuest && Yii::$app->user->identity->id==$model->user_id){ ?>
    <div>
        <a href="<?=Url::to(['elements/create','profession_id'=>$model->id])?>" class="btn-add"><img src="files/plus.png"></a>
    </div>
    <?php } ?>
</div>