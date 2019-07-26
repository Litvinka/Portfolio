<?php

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link href="https://fonts.googleapis.com/css?family=Lato|Montserrat&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js/jquery.maskedinput.min.js"></script>
    <script src="js/main-page.js"></script>
    <script src="js/upload.js"></script>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <header class="header">
         <nav class="main-nav">
            <a class="" href="<?=Yii::$app->homeUrl?>"><h1>Люстэрка</h1></a>
            <div class="">
                <ul class="nav-right-block">
                <?php if(Yii::$app->user->isGuest){ ?>
                       <li><a href="<?=Url::to(['site/login'])?>">Вход</a></li> 
                       <li><a href="<?=Url::to(['site/signup'])?>">Регистрация</a></li>
                
                <?php } else{ ?>
                    <li><a href="<?=Url::to(['site/logout'])?>">Выйти</a></li>
                <?php } ?>
                </ul>
            </div>   
        </nav>
    </header>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <h6 class="copy-h6">&copy; Люстэрка <?= date('Y') ?></h6>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
