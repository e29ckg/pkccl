<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "easy_upload".
 *
 * @property integer $id
 * @property string $name
 * @property string $surname
 * @property string $photo
 * @property string $photos
 */
class Easyupload extends \yii\db\ActiveRecord {
    public $upload_foler = 'uploads';

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'easy_upload';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['photos'], 'string'],
            [['name', 'surname'],'required'],
            [['name', 'surname'], 'string', 'max' => 100],
            [['photo'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'surname' => 'Surname',
            'photo' => 'Photo',
            'photos' => 'Photos',
        ];
    }

    public function upload($model, $attribute) {
        $photo = UploadedFile::getInstance($model, $attribute);
        $path = $this->getUploadPath();
        if ($this->validate() && $photo !== null) {

            $fileName = md5($photo->baseName . time()) . '.' . $photo->extension;
            //$fileName = $photo->baseName . '.' . $photo->extension;
            if ($photo->saveAs($path . $fileName)) {
                return $fileName;
            }
        }
        return $model->isNewRecord ? false : $model->getOldAttribute($attribute);
    }

    public function getUploadPath() {
        return Yii::getAlias('@webroot') . '/' . $this->upload_foler . '/';
    }

    public function getUploadUrl() {
        return Yii::getAlias('@web') . '/' . $this->upload_foler . '/';
    }

    public function getPhotoViewer() {
        return empty($this->photo) ? Yii::getAlias('@web') . '/img/none.png' : $this->getUploadUrl() . $this->photo;
    }

}
