<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\components\CustomHelper;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    //set navigation according users
        //Admin Menus
        $items=[];
         if(!Yii::$app->user->isGuest):
             array_push($items, 
                           ['label' => 'Home', 'url' => ('/site/index')],
                           ['label' => 'Contact', 'url' => Url::to('/site/contact')] 
                     );
             array_push($items,  [
                'label' => CustomHelper::truncateText(Yii::$app->user->identity->name, 20),
                'items' => [
                     ['label' => 'View Profile', 'url' => Url::to('/site/profile')],
                     '<li class="divider"></li>',
                     ['label' => 'Logout', 'url' => Url::to('/site/logout'),'linkOptions' => ['data-method' => 'post']],
                ],
           ]);
         endif;
	 
         
        NavBar::begin([
               'brandLabel' => Yii::$app->name,
               'brandUrl' => Yii::$app->homeUrl,
               'options' => [
                   'class' => 'navbar-inverse navbar-fixed-top',
               ],
           ]);
        echo  Nav::widget([
                'options' => ['class' => 'nav navbar-nav navbar-right'],
                'items' => $items,
            ]);
         
        NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; SP SDP <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
