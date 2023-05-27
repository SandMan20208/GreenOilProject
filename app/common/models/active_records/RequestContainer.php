<?php

namespace common\models\active_records;

use Yii;

/**
 * This is the model class for table "request_container".
 *
 * @property int $id
 * @property int $request_id
 * @property int $container_id
 * @property int $take
 * @property int $weight
 * @property int $volume
 * @property int $give
 *
 * @property Container $container
 * @property Request $request
 */
class RequestContainer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public static function tableName()
    {
        return 'request_container';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['request_id', 'container_id'], 'required'],
            [['request_id', 'container_id', 'take', 'weight', 'volume', 'give'], 'integer'],
            [['container_id'], 'exist', 'skipOnError' => true, 'targetClass' => Container::class, 'targetAttribute' => ['container_id' => 'id']],
            [['request_id'], 'exist', 'skipOnError' => true, 'targetClass' => Request::class, 'targetAttribute' => ['request_id' => 'id']],
            [['take', 'give'], 'validateMoveContainer', 'skipOnEmpty'=> false],
            [['take', 'weight', 'volume'], 'validateWeightAndVolume', 'skipOnEmpty'=> false],
        ];
    }

    public function validateMoveContainer(): void
    {
        if(empty($this->take) && empty($this->give))
        {
            $error = 'Заполните одно из полей';
            $this->addError('take', $error);
            $this->addError('give', $error);
        }

        if (empty($this->take) && (!empty($this->weight) || !empty($this->volume))) {
            $error = 'Заполните поле';
            $this->addError('take', $error);
        }
    }

    public function validateWeightAndVolume(): void
    {
        if(!empty($this->take) && (empty($this->weight) || empty($this->volume)))
        {
            $error = 'Заполните поле';
            if (empty($this->weight)) {
                $this->addError('weight', $error);
            }
            if (empty($this->volume)) {
                $this->addError('volume', $error);
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'request_id' => 'Request ID',
            'container_id' => 'Container ID',
            'container_count' => 'Container Count',
            'take' => 'Забрал шт.',
            'weight' => 'Общая масса в кг',
            'volume' => 'Объем в литрах',
            'give' => 'Чистой тары оставил'
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
     * Gets query for [[Request]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequest()
    {
        return $this->hasOne(Request::class, ['id' => 'request_id']);
    }
}
