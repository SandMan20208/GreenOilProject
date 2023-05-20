<?php

namespace common\models\active_records;

use Yii;

/**
 * This is the model class for table "store".
 *
 * @property int $id
 * @property string $name
 * @property int $city_id
 *
 * @property StoreContainer[] $storeContainers
 */
class Store extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'city_id'], 'required'],
            [['name'], 'string', 'max' => 30],
            [['city_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'city_id' => 'ID склада'
        ];
    }

    /**
     * Gets query for [[StoreContainers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStoreContainers()
    {
        return $this->hasMany(StoreContainer::class, ['store_id' => 'id']);
    }
}
