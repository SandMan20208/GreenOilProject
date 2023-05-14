<?php

namespace common\models\active_records;

use Yii;

/**
 * This is the model class for table "container".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $weight
 * @property int|null $volume
 *
 * @property StoreContainer[] $storeContainers
 */
class Container extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'container';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['weight', 'volume'], 'integer'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'weight' => 'Weight',
            'volume' => 'Volume In Liters',
        ];
    }

    /**
     * Gets query for [[StoreContainers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStoreContainers()
    {
        return $this->hasMany(StoreContainer::class, ['container_id' => 'id']);
    }
}