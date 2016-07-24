<?php

namespace app\controllers;

use app\models\Upload;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;
use yii;

class UploadController extends yii\web\Controller {

    public function actionCreate() {
        $model = new Upload();
        if ($model->load(Yii::$app->request->post())) {
            try {
                $model->image = UploadedFile::getInstance($model, 'image');
                $model->files = UploadedFile::getInstances($model, 'files'); //upload หลายไฟล์ getInstances (เติม s) 
                $model->image = $model->uploadImage(); //method return ชื่อไฟล์ 
                $model->files = $model->uploadFiles(); //method return ชื่อไฟล์ aaaa.aaa, bbbb.bbb, ... 
                $model->save(); //บันทึกข้อมูล /*var_dump($model); die();*/ 
                Yii::$app->session->setFlash('success', 'บันทึกข้อมูลเรียบร้อย');
                return $this->redirect(['index']);
            } catch (Exception $e) {
                Yii::$app->session->setFlash('danger', 'มีข้อผิดพลาด');
                return $this->redirect(['index']);
            }
        }
        return $this->render('//uploads/_form', [ 'model' => $model,]);
    }

    public function actionUpdate($id) {
        $mUpload = $this->loadModel($id);
        if ($mUpload->load(Yii::$app->request->post())) {
            $oldNamepic = $mUpload->image;

            try {
                $mUpload->image = UploadedFile::getInstance($mUpload, 'image');
                $mUpload->files = UploadedFile::getInstances($mUpload, 'files'); //upload หลายไฟล์ getInstances (เติม s) 
                if (!empty($oldNamepic->image)) {
                    $fileName = substr(md5(rand(1, 1000) . time()), 0, 15) . '.' . $this->image->extension;
                    $mUpload->image = $fileName;
                    $mUpload->image();
                } //method return ชื่อไฟล์ 

                $mUpload->files = $mUpload->uploadFiles(); //method return ชื่อไฟล์ aaaa.aaa, bbbb.bbb, 
                //
                $mUpload->save(); //บันทึกข้อมูล 

                Yii::$app->session->setFlash('success', 'บันทึกข้อมูลเรียบร้อย');
                return $this->redirect(['index']);
            } catch (Exception $e) {
                Yii::$app->session->setFlash('danger', 'มีข้อผิดพลาด');
                return $this->redirect(['index']);
            }
        }
        return $this->render('//uploads/update', [
                    'model' => $mUpload
        ]);
    }

    public function actionView($id) {
        $model = $this->loadModel($id);
        return $this->render('//uploads/view', [
                    'model' => $model]);
    }

    public function actionIndex() {
        //$dataProvider = new ActiveDataProvider([ 'query' => Upload::find()]);
        $uploads = Upload::find()->all();

        return $this->render('//uploads/index', [
                    'uploads' => $uploads
        ]);
        //return $this->render('//uploads/index', [ 'dataProvider' => $dataProvider]);
    }

    public function actionDeletefile($id, $file) {

        $model = $this->loadModel($id); //โหลด record ที่ต้องการมา 
        try {
            $files = explode(',', $model->files); //เอาชื่อไฟล์มาแปลงเป็น array 
            $files = array_diff($files, array($file)); //เอาชื่อไฟล์ที่ส่งมามาเอาออกจาก record 
            unlink(Yii::getAlias('@webroot') . '/' . $model->uploadFilesFolder . '/' . $file); //ลบไฟล์ออก 
            $files = implode(',', $files);
            $model->files = $files; //นำไฟล์ใหม่กลับเข้า attribute 
            $model->save(); //บันทึกข้อมูลใหม่ 
            Yii::$app->session->setFlash('success', 'ลบข้อมูลเรียบร้อยแล้ว');
            return $this->redirect(['//upload/update', 'id' => $model->id]);
        } catch (Exception $e) {
            Yii::$app->session->setFlash('success', 'มีข้อผิดพลาด');
            return $this->redirect(['//upload/view', 'id' => $model->id]);
        }
    }

    protected function loadModel($id) {
        $model = Upload::findOne($id);
        if (!$model) {
            throw new \Exception("Error Processing Request", 1);
        } return $model;
    }

}
