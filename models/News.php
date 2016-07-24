<?php

namespace app\models;

use yii\web\UploadedFile;
use Yii;

class News extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public $imageFile; //field of image
    public $newsImageFolder = 'uploads/news'; //ที่เก็บรูปภาพ 
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
                       
            $this->imageFile->saveAs($newsImageFolder."/$bName");
            return TRUE;
        } else {
            return FALSE;
        }
    }
    public function getImage() {
        return Yii::getAlias('@web') . $newsImageFolder.'/' . $this->photo;
    }
    public function getImagenull() {
        return Yii::getAlias('@web') . $newsImageFolder.'/' . 'nopic.png';
    }
}   