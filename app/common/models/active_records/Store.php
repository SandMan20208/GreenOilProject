<?php

namespace common\models\active_records;

use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "store".
 *
 * @property int $id
 * @property string $name
 * @property int $city_id
 *
 * @property StoreContainer[] $storeContainers
 * @property City $city
 */
class Store extends \yii\db\ActiveRecord
{
    const COUNT_OF_EMPTY = 'count_of_empty';
    const COUNT_OF_FULL = 'count_of_full';

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
            'city_id' => 'ID города'
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

    public function getCity()
    {
        return $this->hasOne(City::class, ['id' => 'city_id']);
    }

    public function getCountFullContainers(): int
    {
        return $this->getCountContainers(self::COUNT_OF_FULL);
    }

    public function getCountEmptyContainers(): int
    {
        return $this->getCountContainers(self::COUNT_OF_EMPTY);
    }
    private function getCountContainers(string $countOf): int
    {
        $storeContainers = StoreContainer::findAll(['store_id' => $this->id]);
        $count = 0;
        foreach ($storeContainers as $storeContainer) {
            $count += $storeContainer->$countOf;
        }

        return $count;
    }
}
