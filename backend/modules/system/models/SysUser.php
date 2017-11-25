<?php

namespace backend\modules\system\models;

use common\libs\helpers\AesHelper;
use common\libs\helpers\ConfigHelper;
use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "sys_user".
 *
 * @property integer $id
 * @property string $username
 * @property string $phone_encrypt
 * @property string $passwd
 * @property string $salt
 * @property string $status
 * @property string $create_time
 * @property string $update_time
 */
class SysUser extends \yii\db\ActiveRecord implements IdentityInterface {

	const STATUS_NORMAL = 1;
	const STATUS_BIND = 0;

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'sys_user';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[ [ 'username', 'passwd' ], 'required' ],
			[ [ 'create_time', 'update_time' ], 'safe' ],
			[ [ 'username', 'phone_encrypt' ], 'string', 'max' => 45 ],
			[ [ 'passwd', 'salt' ], 'string', 'max' => 100 ],
			[ [ 'status' ], 'integer', 'max' => 2 ],
			[ [ 'username' ], 'unique' ],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id'            => 'ID',
			'username'      => 'Username',
			'phone_encrypt' => 'Phone Encrypt',
			'passwd'        => 'Passwd',
			'salt'          => 'Salt',
			'status'        => 'Status',
			'create_time'   => 'Create Time',
			'update_time'   => 'Update Time',
		];
	}

	public function getPhone()
	{
		return AesHelper::decrypt( $this->phone_encrypt, ConfigHelper::getUserPhoneAesKey() );
	}

	public function getStatusName()
	{
		switch ( $this->status ) {
			case 0 :
				return '禁用';
			case 1:
				return '正常';
		}
	}

	public function validatePassword( $password )
	{
		return Yii::$app->getSecurity()->validatePassword( $password . $this->salt, $this->passwd );
	}

	public static function editUser( Array $data )
	{
		if( ! ( isset( $data['user_id'] ) && $data['user_id'] && $user = self::findOne( [ 'id' => $data['user_id'] ] ) ) ) {
			$user = new self;
		}
		$user->username      = $data['username'];
		$user->salt          = $user->salt ?: self::getSalt();
		$user->passwd        = $data['passwd'] ? Yii::$app->getSecurity()->generatePasswordHash( $data['passwd'] . $user->salt ) : $user->passwd;
		$user->phone_encrypt = AesHelper::encrypt( $data['phone'], ConfigHelper::getUserPhoneAesKey() );

		return $user->validate() && $user->save() ? true : false;
	}

	static private function getSalt()
	{
		return Yii::$app->getSecurity()->generateRandomString();
	}

	static public function findByUsername( $username )
	{
		return self::findOne( [
			'status'   => self::STATUS_NORMAL,
			'username' => $username,
		] );
	}

	/**
	 * Finds an identity by the given ID.
	 *
	 * @param string|int $id the ID to be looked for
	 *
	 * @return IdentityInterface the identity object that matches the given ID.
	 * Null should be returned if such an identity cannot be found
	 * or the identity is not in an active state (disabled, deleted, etc.)
	 */
	public static function findIdentity( $id )
	{
		return self::findOne( [ 'id' => $id ] );
	}

	/**
	 * Finds an identity by the given token.
	 *
	 * @param mixed $token the token to be looked for
	 * @param mixed $type  the type of the token. The value of this parameter depends on the implementation.
	 *                     For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
	 *
	 * @return IdentityInterface the identity object that matches the given token.
	 *                     Null should be returned if such an identity cannot be found
	 *                     or the identity is not in an active state (disabled, deleted, etc.)
	 */
	public static function findIdentityByAccessToken( $token, $type = null )
	{
		// TODO: Implement findIdentityByAccessToken() method.
	}

	/**
	 * Returns an ID that can uniquely identify a user identity.
	 * @return string|int an ID that uniquely identifies a user identity.
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Returns a key that can be used to check the validity of a given identity ID.
	 *
	 * The key should be unique for each individual user, and should be persistent
	 * so that it can be used to check the validity of the user identity.
	 *
	 * The space of such keys should be big enough to defeat potential identity attacks.
	 *
	 * This is required if [[User::enableAutoLogin]] is enabled.
	 * @return string a key that is used to check the validity of a given identity ID.
	 * @see validateAuthKey()
	 */
	public function getAuthKey()
	{
		// TODO: Implement getAuthKey() method.
	}

	/**
	 * Validates the given auth key.
	 *
	 * This is required if [[User::enableAutoLogin]] is enabled.
	 *
	 * @param string $authKey the given auth key
	 *
	 * @return bool whether the given auth key is valid.
	 * @see getAuthKey()
	 */
	public function validateAuthKey( $authKey )
	{
		// TODO: Implement validateAuthKey() method.
	}
}
