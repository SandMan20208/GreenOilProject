<?php

namespace common\models\active_records;

use Yii;

/**
 * This is the model class for table "restaurant_container".
 *
 * @property int $id
 * @property int|null $container_id
 * @property int|null $restaurant_id
 * @property int|null $container_count
 *
 * @property Container $container
 * @property Restaurant $restaurant
 */
class RestaurantContainer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'restaurant_container';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['container_id', 'restaurant_id', 'container_count'], 'integer'],
            [['container_id'], 'exist', 'skipOnError' => true, 'targetClass' => Container::class, 'targetAttribute' => ['container_id' => 'id']],
            [['restaurant_id'], 'exist', 'skipOnError' => true, 'targetClass' => Restaurant::class, 'targetAttribute' => ['restaurant_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'container_id' => 'Container ID',
            'restaurant_id' => 'Restaurant ID',
            'container_count' => 'Container Count',
        ];
    }

    /**
     * Gets query for [[Container]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getContainer()
    {
        return $this->hasOne(Container::class, ['id' => 'container_id']);
    }

    /**
     * Gets query for [[Restaurant]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRestaurant()
    {
        return $this->hasOne(Restaurant::class, ['id' => 'restaurant_id']);
    }
}
