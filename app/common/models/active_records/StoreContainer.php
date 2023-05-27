<?php

namespace common\models\active_records;

use Yii;

/**
 * This is the model class for table "store_container".
 *
 * @property int $id
 * @property int|null $store_id
 * @property int|null $container_id
 * @property int|null $count_of_empty
 * @property int|null $count_of_full
 * @property int $countContainers
 *
 * @property Container $container
 * @property Store $store
 */
class StoreContainer extends \yii\db\ActiveRecord
{
    public int $countContainers = 0; // Количество добавляемых на склад пустых контейнеров
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_container';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['store_id', 'container_id', 'count_of_empty', 'count_of_full', 'countContainers'], 'integer'],
            [['store_id', 'container_id', 'count_of_empty', 'count_of_full'], 'required'],
            [['store_id'], 'exist', 'skipOnError' => true, 'targetClass' => Store::class, 'targetAttribute' => ['store_id' => 'id']],
            [['container_id'], 'exist', 'skipOnError' => true, 'targetClass' => Container::class, 'targetAttribute' => ['container_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'store_id' => 'Store ID',
            'container_id' => 'Container ID',
            'count_of_empty' => 'Number Of Empty Containers',
            'count_of_full' => 'Number Of Full Containers',
            'countContainers' => 'Добавить, шт.',
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
     * Gets query for [[Store]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStore()
    {
        return $this->hasOne(Store::class, ['id' => 'store_id']);
    }

    public function addContainers()
    {
        $this->count_of_empty += $this->countContainers;
    }
}
