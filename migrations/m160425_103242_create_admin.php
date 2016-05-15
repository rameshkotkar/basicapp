<?php

use yii\db\Migration;
use app\components\CustomHelper;

class m160425_103242_create_admin extends Migration
{
    public function up()
    {
        $email='admin@example.com';
        $model=new app\models\User();
        $model->id = 1;
        $model->firstname='Example';
        $model->lastname='Administrator';
        $model->email = $email;
        //$model->setPassword($password);
        $model->password='d320ad5c8c80126218c62cd06174429d811b1cc8';
        
        $model->contact='9999999999';
        $model->country='IN';
        $model->type = $model::TYPE_ADMIN;
        $model->status = $model::STATUS_ACTIVE;
        $model->generateAuthKey();
        $model->generatePasswordResetToken();
        $model->generateAccessToken();
        $model->save();
    }

    public function down()
    {
         $this->delete('user', ['id' => 1]);
    }
}
