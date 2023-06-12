<?php

namespace common\models\active_records;

use Yii;

/**
 * This is the model class for table "request_document".
 *
 * @property int $id
 * @property string|null $file_path
 * @property int|null $document_type_id
 * @property int|null $request_id
 *
 * @property DocumentType $documentType
 * @property Request $request
 */
class RequestDocument extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request_document';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['document_type_id', 'request_id'], 'integer'],
            [['file_path'], 'string', 'max' => 300],
            [['document_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => DocumentType::class, 'targetAttribute' => ['document_type_id' => 'id']],
            [['request_id'], 'exist', 'skipOnError' => true, 'targetClass' => Request::class, 'targetAttribute' => ['request_id' => 'id']],
            [['file_path','document_type_id', 'request_id'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'file_path' => 'File Path',
            'document_type_id' => 'Document Type ID',
            'request_id' => 'Request ID',
        ];
    }

    /**
     * Gets query for [[DocumentType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentType()
    {
        return $this->hasOne(DocumentType::class, ['id' => 'document_type_id']);
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

    public function saveFilePath(string $filePath, int $requestId)
    {
        $this->file_path = $filePath;
        $this->request_id = $requestId;
        $this->document_type_id = 1;

        $this->save();
    }
}
