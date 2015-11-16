<?php

namespace app\models;

use app\models\User;
use app\models\loginform;
use yii\base\Model;
use yii;

/**
 * LoginForm is the model behind the login form.
 */
class LoginForm extends Model
{
    public $username;
    public $email;
    public $authkey;
    public $rememberMe = true;

    private $_user = false;


    public function rules(){
        return [
                ['email', 'filter', 'filter' => 'trim'],
                ['email', 'required'],
                ['email', 'email'],
                
                ['rememberMe', 'boolean'],
                
                ['authkey', 'required'],
                ['authkey', 'string', 'min' => 6],
                ['authkey', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->authkey)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByEmail($this->email);
        }

        return $this->_user;
    }
    public function attributeLabels(){
        return [
                'username' => '用户名',
                'authkey' => '密码',
                'email'=>'邮箱',
                'rememberMe'=>'记住我',
        ];
    }
}
