<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class ChangePasswordForm extends Model
{
    public $current_password;
    public $new_password;
    public $repeat_password;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['current_password'], 'required'],
            [['new_password', 'repeat_password'], 'required'],
            [['current_password'], 'findPasswords'],
            [['new_password'], 'string', 'min' => 8, 'max' => 32],
            [['new_password'], 'comparePasswords'],
            [['repeat_password'], 'compare', 'compareAttribute'=>'new_password', 'message'=>"Passwords don't match"],
        ];
    }
 
    //matching the old password with your existing password.
    public function findPasswords($attribute, $params)
    {
        $user = User::findById(Yii::$app->user->identity->id);
        if ($user->password != $user->generatePassword($this->current_password))
            $this->addError($attribute, 'Current password is incorrect.');
    }
    
    //matching the old password with your existing password.
    public function comparePasswords($attribute, $params)
    {
       if ($this->current_password == $this->new_password)
            $this->addError($attribute, 'Current password and new password are same.');
    }

     

  
}
