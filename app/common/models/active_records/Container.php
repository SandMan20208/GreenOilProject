<?php

namespace common\models\active_records;

use Yii;
use yii\helpers\ArrayHelper;

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
            [['weight', 'volume', 'name'], 'required'],
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
            'weight' => 'Вес в кг',
            'volume' => 'Объем в литрах',
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

    public static function getContainersIdsAndNames(): array
    {
        $users = Container::find()->all();
        return ArrayHelper::map($users, 'id', 'name');
    }
}
