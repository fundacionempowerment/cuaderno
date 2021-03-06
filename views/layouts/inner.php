<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
$isCoach = Yii::$app->user->identity->is_coach;
$isAdministrator = Yii::$app->user->identity->is_administrator;

$items[] = ['label' => Yii::t('app', 'Home'), 'url' => ['/site/index']];
if ($isAdministrator)
    $items[] = ['label' => Yii::t('app', 'Users'), 'url' => ['/user']];
if ($isCoach)
    $items[] = ['label' => Yii::t('user', 'My Coachees'), 'url' => ['/coachee']];
$items[] = ['label' => Yii::t('user', 'My account'), 'url' => ['/user/my-account']];
$items[] = ['label' => Yii::t('app', 'Logout') . ' (' . Yii::$app->user->identity->username . ')',
    'url' => ['/site/logout'],
    'linkOptions' => ['data-method' => 'post']];
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <link rel="icon" type="image/x-icon" href="/favicon.png" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>

        <?php $this->beginBody() ?>
        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => 'Cuaderno del Coach CPI',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-default navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $items,
            ]);
            NavBar::end();
            ?>

            <div class="container">
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">
                    <?= Html::a('Fundación Empowerment', 'http://www.fundacionempowerment.org/') ?>
                    &nbsp;
                    <?= Html::a('Español', ['site/es']) ?>
                    &nbsp;
                    <?= Html::a('English', ['site/en']) ?>
                </p>
                <p class="pull-right">
                    <?= Yii::t('app', 'Powered by') ?>
                    <?= Html::a('Yii Framework', 'http://www.yiiframework.com/', ['rel' => 'external', 'target' => '_blank']) ?>
                </p>
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
