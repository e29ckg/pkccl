<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\UploadedFile; //for upload

class Product extends ActiveRecord {

    public $upload_foler = 'uploads';
    public $imageFile; //field of image

    public static function tableName() {
        return 'products';
    }

    public function attributeLabels() {
        return [
            'name' => 'ชื่อสินค้า',
            'detail' => 'รายละเอียด',
            'price_buy' => 'ราคาซื้อ',
            'price_sale' => 'ราคาจำหน่าย',
            'img' => 'ภาพสินค้า',
            'status' => 'สถานะ'
        ];
    }

    public function rules() {
        return [
            [['name', 'price_buy', 'price_sale'], 'required'],
            [['name'], 'unique'],
            'skipOnEmpty' => true,
            'extensions' => 'png,jpg'
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

// ...
}
