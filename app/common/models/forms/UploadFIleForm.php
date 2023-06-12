<?php

namespace common\models\forms;

use common\models\active_records\RequestDocument;
use yii\base\Model;

class UploadFIleForm extends Model
{
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload(int $requestId)
    {
        if ($this->validate()) {
            $filePath = 'uploads/' . $this->getFileSavePath($requestId) . $this->imageFile->baseName . '.' . $this->imageFile->extension;
            $this->imageFile->saveAs($filePath);
            $requestDocument = new RequestDocument();
            $requestDocument->saveFilePath($filePath, $requestId);
            return true;
        } else {
            return false;
        }
    }
    public function getFileSavePath(int $requestId): string
    {
        $year = (new \DateTime())->format('Y');
        $month = (new \DateTime())->format('m');
        $day = (new \DateTime())->format('d');
        return "$year/$month/$day/$requestId/";
    }


}