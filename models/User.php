<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\Expression;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    /*public $id;
    public $username;
    public $password;
    public $email;
    public $auth_key;
    public $access_token;

    private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'username' => 'demo',
            'password' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ],
    ];*/

    public static function tableName()
    {
        return 'users';
    }

    public function rules(){
        return [
          [['username','password','email'], 'required'],
          ['email', 'email'],
          [['username','email'], 'unique'],
          [['username', 'password'], 'string', 'max' => 50]
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => \Yii::t('app','username'),
            'password' => \Yii::t('app', 'password')
        ];
    }
/**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        //return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        /*foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }
        return null;*/

        return static::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        /*foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }
        return null;*/
        return static::findOne(['username' => $username]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function generateAuthKey()
    {
        $this->auth_key = md5(uniqid().\Yii::$app->params['hash']);
    }

/**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    public function setPassword($password)
    {
        $this->password = md5($password);
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->updated_at = new Expression('NOW()');
                $this->generateAuthKey();
            }
            return true;
        }
        return false;
    }

    public function getArticles(){
        return $this->hasMany(Article::className(), ['id' => 'user_id']);
    }
}
