<?php

namespace common\models\active_records;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $login
 * @property string $password
 * @property string|null $name
 * @property int|null $phone
 * @property string|null $car_model
 *
 * @property Request[] $requests
 * @property RoleUser[] $roleUsers
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['login', 'password'], 'required'],
            [['phone'], 'integer'],
            [['login', 'password', 'name', 'car_model'], 'string', 'max' => 255],
            [['login'], 'unique'],
            [['login', 'password', 'name'], 'required']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Login',
            'password' => 'Password',
            'name' => 'Name',
            'phone' => 'Phone',
            'car_model' => 'Car Model',
        ];
    }

    /**
     * Gets query for [[Requests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasMany(Request::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[RoleUsers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRoleUsers()
    {
        return $this->hasMany(RoleUser::class, ['user_id' => 'id']);
    }

    public static function getUsersIdsAndNames(): array
    {
        $users = User::find()->all();
        return ArrayHelper::map($users, 'id', 'name');
    }
}
