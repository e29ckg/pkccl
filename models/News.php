<?php

namespace app\models;

use yii\web\UploadedFile;
use Yii;

class News extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public $imageFile; //field of image
    public $Bname;

    public static function tableName() {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['h_news', 'detail'], 'required'],
            [['detail'], 'string'],
            [['h_news', 'photo'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'h_news' => 'H News',
            'detail' => 'Detail',
            'photo' => 'รูปภาพ',
        ];
    }

    public function upload($bName) {
        if ($this->validate()) {           
                       
            $this->imageFile->saveAs("uploads/$bName");
            return TRUE;
        } else {
            return FALSE;
        }
    }
}   