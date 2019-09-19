<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

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
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([

        'brandLabel' => '<img src="/images/img/logo_admin.png" class="pull-left img_logo_admin"/>',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Главная', 'url' => ['/user/index']],

            ['label' => 'Прайс-лист', 'url' => ['/upload/price.xls']],
            ['label' => 'О компании', 'url' => ['/site/info']],
            ['label' => 'Сертифиаты и лицензии', 'url' => ['/site/gallery']],
            ['label' => 'Контакты', 'url' => ['/site/place']],



            Yii::$app->user->isGuest ? (
            ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Выход (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">


        <div class="header-bottom"><!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse"
                                    data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li class="dropdown"><a href="#">Визитка<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                <li><a href="<?= \yii\helpers\Url::to(['gallery/index']) ?>">Сертификаты</a></li>
                                <li><a href="<?= \yii\helpers\Url::to(['contact/index']) ?>">Контакты</a></li>
                                <li><a href="<?= \yii\helpers\Url::to(['discount/index']) ?>">Слайдер</a></li>
                                <li><a href="<?= \yii\helpers\Url::to(['sertificat/index']) ?>">Партнеры</a></li>
                                <li><a href="<?= \yii\helpers\Url::to(['info/index']) ?>">О компании</a></li>
                                <li><a href="<?= \yii\helpers\Url::to(['test/index']) ?>">Загрузка прайса</a></li>
                                    </ul>
                                </li>

                                <li class="dropdown"><a href="#">Пользователи<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="<?=\yii\helpers\Url::to(['user/index'])?>">Список пользователей</a></li>
                                        <li><a href="<?=\yii\helpers\Url::to(['user/signup'])?>">Добавить пользователя</a></li>
                                    </ul>
                                </li>
                                <li><a href="<?= \yii\helpers\Url::to(['/exchange/default/index']) ?>">Обмен</a></li>
                                <li><a href="<?= \yii\helpers\Url::to(['offer/index']) ?>">Товары</a></li>
                               
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="search_box pull-right">

                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-bottom-->
        </header><!--/header-->
        <div class="container">
            <?php if (Yii::$app->session->hasFlash('success')): ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <?php echo Yii::$app->session->getFlash('success'); ?>
                </div>
            <?php endif; ?>
            <?= $content ?>
        </div>


    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Лема-Прим <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
