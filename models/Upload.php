<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * This is the model class for table "upload".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $image
 * @property string $files
 */
class Upload extends \yii\db\ActiveRecord {

    public $uploadImageFolder = 'uploads/images'; //ที่เก็บรูปภาพ 
    public $uploadFilesFolder = 'uploads/files'; //ที่เก็บไฟล์

    /**
     * @inheritdoc
     */

    public static function tableName() {
        return 'upload';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['title'], 'required'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['image'], 'file', 'extensions' => 'jpg, png, gif'], //กำหนดให้เป็นแบบ file            
            [['files'], 'file', 'maxFiles' => 10], //กำหนดให้เป็นแบบ file ตรงนี้สามารถกำหนดนามสกุลได้นะครับ เหมือนกันกับแบบของรูปภาพ 
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'title' => 'หัวเรื่อง',
            'content' => 'เนื้อหา',
            'image' => 'รูปภาพ',
            'files' => 'ไฟล์',
        ];
    }

    /*
     * UploadImage เป็น Method ในการ upload รูปภาพในที่นี้จะ upload ได้เพียงไฟล์เดียว โดยจะ return ชื่อไฟล์
     */

    public function uploadImage() {

        if ($this->validate()) {
            if ($this->image) {
                if ($this->isNewRecord) {//ถ้าเป็นการเพิ่มใหม่ ให้ตั้งชื่อไฟล์ใหม่
                    $fileName = substr(md5(rand(1, 1000) . time()), 0, 15) . '.' . $this->image->extension; //เลือกมา 15 อักษร .นามสกุล
                } else {//ถ้าเป็นการ update ให้ใช้ชื่อเดิม
                    $fileName = $this->getOldAttribute('image');
                }
                $this->image->saveAs(Yii::getAlias('@webroot') . '/' . $this->uploadImageFolder . '/' . $fileName);

                return $fileName;
            }//end image upload
        }//end validate
        return $this->isNewRecord ? false : $this->getOldAttribute('image'); //ถ้าไม่มีการ upload ให้ใช้ข้อมูลเดิม
    }

//UploadFiles เป็น Method ในการ upload หลายไฟล์ สูงสุด 10 ไฟล์ตามที่ได้กำหนดจาก rules() และจะ return ชื่อไฟล์ aaaa.aaa, bbbb.bbb, ....

    public function uploadFiles() {
        $fileName = []; //กำหนดชื่อไฟล์ที่จะ return
        if ($this->validate()) {
            if ($this->files) {
                foreach ($this->files as $file) {
                    $fileName = substr(md5(rand(1, 1000) . time()), 0, 15) . '.' . $file->extension;
                    $file->saveAs(Yii::getAlias('@webroot') . '/' . $this->uploadFilesFolder . '/' . $fileName);
                    $filesName[] = $fileName;
                }

                if ($this->isNewRecord) {
                    return implode(',', $filesName);
                } else {
                    return implode(',', ArrayHelper::merge($fileName, $this->getOldAttribute($file) ? explode(',', $this->getOldAttribute('file')) : []));
                }
            }//end files upload
        }//end validate
        return $this->isNewRecord ? FALSE : $this->getOldAttribute('file'); //ถ้าไม่มีการ upload ให้ใช้ข้อมูลเดิม
    }

    public function deleteImage($name) {
        $uploads = Upload::findOne($id);
        if (file_exists('uploads/images' . $uploads->image) && ($uploads->image)) {
            unlink('uploads/images' . $uploads->image);
            return TRUE;
        }
        return FALSE;
    }

    //getImage เป็น method สำหรับเรียกที่เก็บไฟล์ เพื่อนำไปแสดงผล 
    public function getImage() {
        return Yii::getAlias('@web') . '/' . $this->uploadImageFolder . '/' . $this->image;
    }

    public function getFilesfolder() {
        return Yii::getAlias('@web') . '/' . $this->uploadFilesFolder . '/';
    }

    public function getFiles() {
        return explode(',', $this->files);
    }

}
