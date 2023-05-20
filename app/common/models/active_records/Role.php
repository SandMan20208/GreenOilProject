<?php

namespace common\models\active_records;

use Yii;

/**
 * This is the model class for table "role".
 *
 * @property int $id
 * @property string|null $role
 *
 * @property RoleUser[] $roleUsers
 */
class Role extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'role';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role'], 'string', 'max' => 255],
            [['role'], 'required']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role' => 'Role',
        ];
    }

    /**
     * Gets query for [[RoleUsers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRoleUsers()
    {
        return $this->hasMany(RoleUser::class, ['role_id' => 'id']);
    }
}
