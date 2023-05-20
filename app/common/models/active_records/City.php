<?php

namespace common\models\active_records;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "cities".
 *
 * @property int $id
 * @property string $name
 *
 * @property Restaurant[] $restaurants
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 30],
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
        ];
    }

    /**
     * Gets query for [[Restaurants]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRestaurants()
    {
        return $this->hasMany(Restaurant::class, ['city_id' => 'id']);
    }

    public static function getCityIdsAndNames(): array
    {
        $requestStatuses = City::find()->all();
        return ArrayHelper::map($requestStatuses, 'id', 'name');
    }
}
