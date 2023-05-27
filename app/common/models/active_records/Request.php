<?php

namespace common\models\active_records;

use Yii;

/**
 * This is the model class for table "request".
 *
 * @property int $id
 * @property int|null $restaurant_id
 * @property int|null $user_id
 * @property int|null $status_id
 * @property int|null $date_created
 * @property string|null $planned_visit_date
 * @property string|null $close_date
 * @property int|null $deleted
 * @property string|null $comment
 * @property int $store_id
 *
 * @property Store $store
 * @property RequestDocument[] $requestDocuments
 * @property RequestContainer[] $requestContainers
 * @property Restaurant $restaurant
 * @property RequestStatus $status
 * @property User $user
 */
class Request extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['restaurant_id', 'user_id', 'status_id', 'deleted', 'store_id'], 'integer'],
            [['planned_visit_date', 'close_date'], 'safe'],
            [['comment'], 'string', 'max' => 150],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => RequestStatus::class, 'targetAttribute' => ['status_id' => 'id']],
            [['restaurant_id'], 'exist', 'skipOnError' => true, 'targetClass' => Restaurant::class, 'targetAttribute' => ['restaurant_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['restaurant_id', 'user_id', 'status_id', 'date_created', 'deleted','planned_visit_date', 'store_id'], 'required'],
            [['date_created'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'restaurant_id' => 'Restaurant ID',
            'user_id' => 'User ID',
            'status_id' => 'Status ID',
            'date_created' => 'Дата создания',
            'planned_visit_date' => 'Планируемая дата визита',
            'close_date' => 'Дата закрытия',
            'deleted' => 'Deleted',
            'comment' => 'Комментарий',
            'store_id' => 'Склад'
        ];
    }

    /**
     * Gets query for [[RequestDocuments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequestDocuments()
    {
        return $this->hasMany(RequestDocument::class, ['request_id' => 'id']);
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

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(RequestStatus::class, ['id' => 'status_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getStore()
    {
        return $this->hasOne(Store::class, ['id' => 'store_id']);
    }

    public function getRequestContainers()
    {
        return $this->hasMany(RequestContainer::class, ['request_id' => 'id']);
    }

    public static function getRequestsByUserId(int $id): array
    {
        return Request::findAll(['user_id' => $id, 'status_id' => RequestStatus::STATUS_PROCESSED_ID]);
    }
    public function executed(): void
    {
        $this->status_id = RequestStatus::STATUS_EXECUTED_ID;
        $this->save();
    }
    public function close(): void
    {
        $this->status_id = RequestStatus::STATUS_CLOSED_ID;
        $this->save();
    }
}
