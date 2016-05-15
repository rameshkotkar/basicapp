<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form ActiveForm */

$this->title = 'Forgot Password';
//$this->params['breadcrumbs'][] =  $this->title;
?>
<?php echo Yii::$app->controller->renderPartial('_flash'); ?>

<div id="Forgotbox"  class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                <div class="panel-heading">
                        <div class="panel-title"><?=Yii::t('app', 'Forgot password');?></div>
                        <div class="forgotPass" style=" float:right; font-size: 80%;  position: relative; top:-10px"><?= Html::a(Yii::t('app', 'Log In'), Yii::$app->urlManager->createUrl('/site/login')); ?></div>
                    </div>     
                    <div class="panel-body" >
    <p>Please Enter Your Email to reset your password :</p>
    
     <?php $changePassForm = ActiveForm::begin([
        'id' => 'forgot-password-form',
      /*  'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-4\">{input}</div>\n<div class=\"col-lg-4\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],*/
    ]); ?>
        <?= $changePassForm->field($model, 'email')->textInput(array('placeholder'=>$model->getAttributeLabel('email')))->label(false) ?>
       
        <div class="form-group">
            <div class="">
               <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>

</div>
</div>
</div>
<!-- site-profile -->

