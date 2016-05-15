<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form ActiveForm */

$this->title = 'Reset Password';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<div class="site-content">
    <?php echo Yii::$app->controller->renderPartial('_flash'); ?>
     <?php $changePassForm = ActiveForm::begin([
        'id' => 'reset-password-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-4\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-2 control-label'],
        ],
    ]); ?>
        <?= $changePassForm->field($model, 'new_password')->passwordInput() ?>
        <?= $changePassForm->field($model, 'repeat_password')->passwordInput() ?>
        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-11">
               <?= Html::submitButton('Reset', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-profile -->

