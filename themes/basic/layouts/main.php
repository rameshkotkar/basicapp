<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\components\CustomHelper;

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
              if(Yii::$app->user->identity->isAdmin):
                  //admin links
                  array_push($items, 
                           ['label' => 'Home', 'url' =>  Yii::$app->urlManager->createUrl('/site/index')]
                      );
              endif; 
              
              if(Yii::$app->user->identity->isManager): 
                   //manager stuff
                   array_push($items, 
                           ['label' => 'Home', 'url' =>  Yii::$app->urlManager->createUrl('/site/index')]
                      );
              endif; 
              if(Yii::$app->user->identity->isUser): 
                   //User stuff
                   array_push($items, 
                           ['label' => 'Home', 'url' =>  Yii::$app->urlManager->createUrl('/site/index')]
                      );
              endif; 
              //common links  
              array_push($items,  [
                'label' => CustomHelper::truncateText(Yii::$app->user->identity->name, 20),
                'items' => [
                     ['label' => 'View Profile', 'url' => Yii::$app->urlManager->createUrl('/site/profile')],
                     '<li class="divider"></li>',
                     ['label' => 'Logout', 'url' =>  Yii::$app->urlManager->createUrl('/site/logout'),'linkOptions' => ['data-method' => 'post']],
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
        <p class="pull-left">&copy; Example <?= date('Y') ?>, All Rights Reserved.</p>
        <p >&nbsp;<?=Html::a('Support', Yii::$app->urlManager->createUrl('/site/contact')); ?></p> 
        <!--<p class="pull-right"><?  //Yii::powered() ?></p>-->
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
