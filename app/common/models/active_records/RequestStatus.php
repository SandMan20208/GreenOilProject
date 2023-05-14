<?php

namespace common\models\active_records;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "request_status".
 *
 * @property int $id
 * @property string|null $status
 * @property string|null $status_name
 *
 * @property Request[] $requests
 */
class RequestStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public const STATUS_NEW_ID = 1;
    public const STATUS_EXECUTED_ID = 2;
    public static function tableName()
    {
        return 'request_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'status_name'], 'string', 'max' => 25],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'status_name' => 'Status Name',
        ];
    }

    /**
     * Gets query for [[Requests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasMany(Request::class, ['status_id' => 'id']);
    }

    public static function getRequestStatusesIdsAndNames(): array
    {
        $requestStatuses = RequestStatus::find()->all();
        return ArrayHelper::map($requestStatuses, 'id', 'name');
    }
}
