<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form ActiveForm */

$this->title = 'Change Password';
$this->params['breadcrumbs'] = [['label' => 'Profile', 'url' => [Yii::$app->urlManager->createUrl('site/profile')]], $this->title];
?>
<?php echo Yii::$app->controller->renderPartial('_flash'); ?>
<div id="changePassbox"  class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
    <div class="panel panel-info" >
            <div class="panel-heading">
                    <div class="panel-title"><?=Yii::t('app', 'Change password');?></div>
            </div>     
       <div class="panel-body" >  
            <?php $changePassForm = ActiveForm::begin([
               'id' => 'change-password-form',
               // 'action'=>'/site/changepassword',
             /*  'options' => ['class' => 'form-horizontal'],
               'fieldConfig' => [
                   'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-4\">{error}</div>",
                   'labelOptions' => ['class' => 'col-lg-2 control-label'],
               ],*/
           ]); ?>
               <?= $changePassForm->field($model, 'current_password')->passwordInput() ?>
               <?= $changePassForm->field($model, 'new_password')->passwordInput() ?>
               <?= $changePassForm->field($model, 'repeat_password')->passwordInput() ?>
               <div class="form-group">
                   <div class="">
                      <?= Html::submitButton(Yii::t('app', 'Change'), ['class' => 'btn btn-primary']) ?>
                   </div>
               </div>
           <?php ActiveForm::end(); ?>
      </div>
   </div>
</div><!-- site-profile -->

