<?php

namespace common\models\active_records;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "restaurant".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $city_id
 * @property string|null $address
 * @property string|null $contact_phone
 *
 * @property City $city
 */
class Restaurant extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'restaurant';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['city_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['address'], 'string', 'max' => 150],
            [['contact_phone'], 'string', 'max' => 12],
            [['name', 'city_id', 'address'], 'required'],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::class, 'targetAttribute' => ['city_id' => 'id']],
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
            'city_id' => 'ID Города',
            'address' => 'Адрес',
            'contact_phone' => 'Телефон',
        ];
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::class, ['id' => 'city_id']);
    }

    public static function getRestaurantsIdsAndNames(): array
    {
        $restaurants = Restaurant::find()->all();
        return ArrayHelper::map($restaurants, 'id', 'name');
    }
}
