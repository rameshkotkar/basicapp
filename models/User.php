<?php

namespace app\models;

use Yii;
//use yii\db\Expression;
use yii\web\IdentityInterface;
 

/**
 * This is the model class for table "user".
 *
 * @property string $id
 * @property string $firstname
 * @property string $lastname
 * @property string $password
 * @property string $email
 * @property string $auth_key
 * @property string $password_reset_token
 * @property string $contact
 * @property string $country
 * @property string $access_token
 * @property integer $type
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    const PASSWORD_SALT='2TFQ200TzZ';
    const TYPE_USER = 0;
    const TYPE_ADMIN = 1; 
    const TYPE_MANAGER = 2;

    const STATUS_INACTIVE= 0;
    const STATUS_ACTIVE= 1;
    const STATUS_DELETE= 2;
    
    //public $new_password;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstname','lastname', 'auth_key', 'email', 'contact', 'country', 'access_token', 'type', 'status'], 'required'],
	         ['password','required','on'=>['create']],
	        [['password', 'email'], 'trim'],
            [['type', 'status'], 'integer'],
            [['firstname', 'lastname'], 'string', 'max' => 50],
            [['firstname', 'lastname'], 'match', 'pattern' => '/^[a-zA-Z ]*$/'],
            [['email'], 'string', 'min' => 8, 'max' => 100],
            [['password'], 'string', 'min' => 8, 'max' => 45],
            [['auth_key'], 'string', 'max' => 32],
            [['password_reset_token'], 'string', 'max' => 255],
            [['contact'], 'match', 'pattern' => '/^[0-9]*$/'],
            ['contact', 'string', 'min' => 10, 'max' => 15, 'message'=>'{attribute} must be minimum 10 and maximum 15 in length.'],
            [['country'], 'string', 'max' => 2],
            [['access_token'], 'string', 'min'=>32, 'max' => 32],
            [['access_token'], 'match', 'pattern' => '/^[a-zA-Z0-9]*$/'],
            ['email','email'],
            [['access_token'], 'unique'],
            ['email', 'unique', 'filter'=>['!=', 'status', self::STATUS_DELETE]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app','ID'),
            'firstname' => Yii::t('app','First Name'),
            'lastname' => Yii::t('app','Last Name'),
            'password' => Yii::t('app','Password'),
            'auth_key' => Yii::t('app','Auth Key'),
            'password_reset_token' => Yii::t('app','Password Reset Token'),
            'email' => Yii::t('app','Email/Username'),
            'contact' => Yii::t('app','Contact'),
            'country' => Yii::t('app','Country'),
            'access_token' => Yii::t('app','Access Token'),
            'type' => Yii::t('app','Type'),
            'status' => Yii::t('app','Status'),
            'created_at' => Yii::t('app','Created At'),
            'updated_at' => Yii::t('app','Updated At'), 
            'name' => Yii::t('app', 'Name')
        ];
    }

	 
    /** INCLUDE USER LOGIN VALIDATION FUNCTIONS**/
     /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
          return static::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param  string  $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['email' => $username, 'status'=> self::STATUS_ACTIVE]);
    }
    
    /**
     * Finds user by id
     *
     * @param  string  $userId
     * @return static|null
     */
    public static function findById($userId)
    {
        return static::findOne(['id' => $userId, 'status'=> self::STATUS_ACTIVE]);
    }
    
    /*
     * set name of user
     * @return string 
    */
    public function getName()
    {
       return ($this->firstname." ".$this->lastname);   
    }

   /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }
        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }
    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }
    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password ===  sha1($password.self::PASSWORD_SALT);//sha1($password);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password =  sha1($password.self::PASSWORD_SALT); // Security::generatePasswordHash($password);
    }
    
    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function generatePassword($password)
    {
        return sha1($password.self::PASSWORD_SALT);
    }
    
    /**
     * Generates API for  authentication of user
     */
    public function generateAccessToken()
    {
        $this->access_token = md5(Yii::$app->getSecurity()->generateRandomString());
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->getSecurity()->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->getSecurity()->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
	
    /**
     * Save dates before save the record
     */
     public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->created_at = time();
            }
            $this->updated_at = time();
            return true;
        }
        return false;
    }

    /*
    * get status of user
    */
    public function getStatusOptions()
    {
        $listStatus = [ self::STATUS_ACTIVE=>"Active", self::STATUS_INACTIVE=>"Inactive", ];
        return $listStatus;
    }

    /*
     * check user is admin or not
     * @return boolen 
     */
    public function getIsAdmin()
    {
        if ($this->type===self::TYPE_ADMIN){
              return true;
        } else {
             return false;
        }
    }
    /*
     * check user is manager or not
     * @return boolen 
     */
    public function getIsManager()
    {
        if ($this->type===self::TYPE_MANAGER) {
          return true;
        } 
        else {
           return false;
        }
    }
    /*
     * check user is normal user or not
     * @return boolen 
     */
    public function getIsUser()
    {
        if ($this->type===self::TYPE_USER) {
          return true;
        } 
        else {
           return false;
        }
    }
	
}
