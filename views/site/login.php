<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Login';
//$this->params['breadcrumbs'][] = $this->title;
?>
<style>
#loginbox {
    margin-top: 50px;
}

#loginbox > div:first-child {        
    padding-bottom: 10px;    
}

#login-form > div:last-child {
    margin-top: 10px;
    margin-bottom: 10px;
}
.panel-body {
    padding-top: 30px;
}
.forgotPass{
    float:right; 
    font-size: 80%; 
    position: relative; 
    top:-10px
}
</style>
     <div id="loginbox"  class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Hello !</div>
                        <div class="forgotPass"><?= Html::a(Yii::t('app', 'Forgot password').'?', Yii::$app->urlManager->createUrl('/site/forgotpassword')); ?></div>
                    </div>     
                    <div class="panel-body" >
                        <?php
                       
                            foreach ($model->getErrors('password')as $key => $message) {
                                echo '<div class="alert alert-danger"><i class="glyphicon glyphicon-info-sign"></i> ' . $message . '</div>';
                            }
                            $form = ActiveForm::begin([
                                            'id' => 'login-form',
                                               'options' => ['class' => 'form-horizontal'],
                                                   'fieldConfig' => [
                                                       'template' => "{input}",
                                                       'options'=>[
                                                       ],
                                                      // 'labelOptions' => ['class' => 'col-lg-2 control-label'],
                                                  ], 
                                ]);
                           ?>
                        <div  class="input-group" style="margin-bottom: 25px;">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                         <?= $form->field($model, 'username',[
                                            'inputOptions'=>[
                                                'class'=>'form-control',
                                                'placeholder'=>$model->getAttributeLabel('username')
                                            ]])->label(false) ?>
                            </div>
                                
                            <div  class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                         <?= $form->field($model, 'password',[
                                            'inputOptions'=>[
                                                'class'=>'form-control',
                                                'placeholder'=>$model->getAttributeLabel('password')
                                            ]])->passwordInput()->label(false) ?>
                                    </div>
                            <div class="input-group">
                                      <div class="checkbox">
                                          <?=$form->field($model, 'rememberMe', [ //'template' => "<div class=\" col-lg-6\">{input}{error}</div>",
                                            ])->checkbox()  ?>
                                      </div>
                            </div>


                                <div class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls">
                                         <?= Html::submitButton('<i class="glyphicon glyphicon-log-in"></i> '.Yii::t('app', 'Log In'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                                       
                                     </div>
                                </div>
                                 <!--<div class="form-group">
                                    <div class="col-md-12 control">
                                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                            Don't have an account! 
                                        <a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                                            Sign Up Here
                                        </a>
                                        </div>
                                    </div>  
                                </div>-->    
                           <?php ActiveForm::end(); ?>
                        </div>                    
                    </div>  
        </div>
   
