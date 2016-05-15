<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form ActiveForm */

$this->title = 'Profile';
$this->params['breadcrumbs'][] = $this->title;
?>
  <?php echo Yii::$app->controller->renderPartial('_flash'); ?>
<div class="site-profile">	  
    <div class="pull-right">
       <?= Html::a('<i class="glyphicon glyphicon-plus"></i>Change Password', ['/site/changepassword'], ['class'=>'btn btn-success', 'style'=>'margin:0px 0px 0px; 0']) ?>
    </div>
     <?php $profileForm = ActiveForm::begin([
        'id' => 'profile-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-6\">{input}</div>\n<div class=\"col-lg-4\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-2 control-label'],
        ],
    ]); ?>

        <?= $profileForm->field($model, 'firstname') ?>
        <?= $profileForm->field($model, 'lastname') ?>
        <?= $profileForm->field($model, 'email') ?>
        <?= $profileForm->field($model, 'contact') ?>
       <?php echo $profileForm->field($model, 'access_token' 
	        ,['template' => "{label}\n<div class=\"col-sm-6\">{input}</div>\n<div class=\"col-sm-4\">{hint}</div>\n<div class=\"col-sm-2\">{error}</div>"]
			)
             ->textInput(array('readonly'=>'readonly'))->hint(
                            Html::a('<i class="glyphicon glyphicon-refresh"></i> Genereate Key','#', [
                                    'onclick'=>"
                                      $.ajax({
                                     type     :'POST',
                                     cache    : false,
                                     url  : '".Yii::$app->urlManager->createUrl('site/generate-api-key')."',
                                     success  : function(response) {
                                         $('#user-access_token').val(response);
                                     }
                                     });return false;",
                                  ])); ?>
     
        <?=$profileForm->field($model, 'country')
                ->dropDownList(Yii::$app->Country->countryList,  ['prompt'=>'---- Select Country ----']); ?>
         
        <div class="form-group">
            <div class="col-sm-5" align="center">
               <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
   
  	  

</div>	
  <!-- site-profile -->
