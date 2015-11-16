<?php
namespace app\models;

use app\models\User;
use yii\base\Model;
use Yii;

class SignupForm extends Model
{
	public $username;
	public $email;
	public $authkey;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
				['username', 'filter', 'filter' => 'trim'],
				['username', 'required'],
				['username', 'unique', 'targetClass' => 'app\models\User', 'message' => '用户名已经被使用'],
				['username', 'string', 'min' => 2, 'max' => 20],

				['email', 'filter', 'filter' => 'trim'],
				['email', 'required'],
				['email', 'email'],
				['email', 'unique', 'targetClass' => 'app\models\User', 'message' => '邮箱已经被使用'],

				['authkey', 'required'],
				['authkey', 'string', 'min' => 6],
		];
	}

	/**
	 * Signs user up.
	 *
	 * @return User|null the saved model or null if saving fails
	 */
	public function signup()
	{
		if ($this->validate()) {
			$user = new User();
			$user->username = $this->username;
			$user->email = $this->email;
			$user->setPassword($this->authkey);
			//$user->generateAuthKey();
			if ($user->save()) {
				return $user;
			}
		}

		return null;
	}
	public function attributeLabels()
	{
		return [
				'username' => '昵称',
				'email'=>'邮箱',
				'authkey'=>'密码',
		];
	}
}
