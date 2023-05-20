<?php

namespace common\models\active_records;

use Yii;

/**
 * This is the model class for table "document_type".
 *
 * @property int $id
 * @property string|null $type
 *
 * @property RequestDocument[] $requestDocuments
 */
class DocumentType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'document_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type'], 'string', 'max' => 100],
            [['type'],'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
        ];
    }

    /**
     * Gets query for [[RequestDocuments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequestDocuments()
    {
        return $this->hasMany(RequestDocument::class, ['document_type_id' => 'id']);
    }
}
