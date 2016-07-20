<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\User;
use yii\web\Session;
use app\models\Product;
use app\models\News;
use yii\web\UploadedFile;
use Yii;

class BackendController extends controller {

    public function actionIndex() {
        $user = new User();

        $post = \Yii::$app->request->post();

        if (!empty($post)) {
            $user = User::find()->where([
                        'usr' => $post['User']['usr'],
                        'pwd' => $post['User']['pwd'],
                        'status' => 'open'
                    ])->one();

            $session = new Session();

            if (!empty($user)) {
                $session['user'] = $user;
                return $this->redirect(['home']);
            } else {
                $user = new User();
                $user->usr = $post['User']['usr'];
                $user->pwd = $post['User']['pwd'];
                $session->setFlash('message', 'Username Invalid !!');
            }
        }

        return $this->render('//backend/index', [
                    'user' => $user
        ]);
    }

    public function actionHome() {
//        return $this->render('//backend/home');
        return $this->render('//news/index');
    }

    public function actionNewsc() {
        return $this->render('//backend/newsc');
    }

    public function actionLogout() {
        $session = new Session();
        unset($session['user']);

        return $this->redirect(['index']);
    }

    public function actionUser() {
        $users = User::find()->all();

        return $this->render('//backend/user', [
                    'users' => $users
        ]);
    }

    public function actionUserform($id = NULL) {
        $user = new User();
        $user->level = 'manager';

        $post = \Yii::$app->request->post();

        if (!empty($id)) {
            $user = User::findOne($id);
        }

        if (!empty($post)) {
            $user->name = $post['User']['name'];
            $user->usr = $post['User']['usr'];
            $user->pwd = $post['User']['pwd'];
            $user->level = $post['User']['level'];
            $user->status = 'open';

            if ($user->save()) {
                $session = new Session();
                $session->setFlash('message', 'บันทึกผู้ใช้งานเรียบร้อย');

                return $this->redirect(['user']);
            }
        }

        return $this->render('//backend/userform', [
                    'user' => $user
        ]);
    }

    public function actionUserdelete($id) {
        $user = User::findOne($id);

        if ($user->delete()) {
            $session = new Session();
            $session->setFlash('message', 'ลบผู้ใช้ เรียบรัอยแล้ว');

            return $this->redirect(['user']);
        }
    }

    public function actionProduct() {
        $session = new Session();
        if (!($session['user'])) {
            if ($session['user'] == 'manager') {
                return $this->redirect(['index']);
            }
        }

        $products = Product::find()->all();

        return $this->render('//backend/product', [
                    'products' => $products
        ]);
    }

    public function actionProductupdate($id) {
        $model = Product::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->photo = $model->upload($model, 'photo');
            $model->save();
            return $this->redirect(['product_form', 'id' => $model->id]);
        } else {
            return $this->render('productform', [
                        'products' => $model,
            ]);
        }
    }

    public function actionNews() {
        $news = News::find()->all();

        return $this->render('//backend/news', [
                    'news' => $news
        ]);
    }

    public function actionNewsdelete($id) {
        $news = News::findOne($id);

        if (file_exists('uploads/' . $news->photo) && ($news->photo)) {
            unlink('uploads/' . $news->photo);
        }

        if ($news->delete()) {

            $session = new Session();
            $session->setFlash('message', 'ลบ-เรียบรัอยแล้ว');

            return $this->redirect(['news']);
        }
    }

    public function actionNewsform($id = NULL) {

        $news = new News();
        
        if (!empty($id)) {
            $news = News::findOne($id);
        }

        $post = \Yii::$app->request->post();

        if (!empty($post)) {

            $news->h_news = $post['News']['h_news'];
            $news->detail = $post['News']['detail'];

            $news->imageFile = UploadedFile::getInstance($news, 'photo');

            if (!empty($news->imageFile)) {
                
                if (file_exists('uploads/' . $news->photo) && ($news->photo)) {
                    unlink('uploads/' . $news->photo);
                }
                $bName = md5($news->imageFile->baseName . time()) . '.' . $news->imageFile->extension;

                if ($news->upload($bName)) {
                    $news->photo = $bName;
                }
            }

            if ($news->save($news)) {
                $session = new Session();
                $session->setFlash('message', 'บันทึกสินค้าแล้ว');

                return $this->redirect(['news']);
            }
        }
        
        return $this->render('//backend/newsform', [
                    'news' => $news
        ]);
    }

}

//    public function actionProductform($id = NULL) {
//        $product = new Product();
//
//        if (!empty($id)) {
//            $product = Product::findOne($id);
//        }
//
//        $post = \Yii::$app->request->post();
//
//        if (!empty($post)) {
//            $product->name = $post['Product']['name'];
//            $product->detail = $post['Product']['detail'];
//            $product->price_buy = $post['Product']['price_buy'];
//            $product->price_sale = $post['Product']['price_sale'];
//            $product->status = 'show';
//            $product->created_at = new \yii\db\Expression('NOW()');
//
//            $product->imageFile = UploadedFile::getInstance($product, 'img');
//
//            if (!empty($product->imageFile)) {
//
//
//
//                if ($product->upload()) {
//
//                    if ($product->img) {
//                        unlink('uploads/' . $product->img);
//                    }
//                    
////                    $product->img = $product->imageFile->name;
//                    $product->img = $product->namerand();
//                }
//            }
//
//            if ($product->save()) {
//                $session = new Session();
//                $session->setFlash('message', 'บันทึกสินค้าแล้ว');
//
//                return $this->redirect(['product']);
//            }
//        }
//
//        return $this->render('//backend/productform', [
//                    'product' => $product
//        ]);
//    }
//    public function actionProductdelete($id) {
//        $product = Product::findOne($id);
//
////        if ($product->img){
////            unlink('uploads/'.$product->img);
////        }
//
//        if (file_exists('uploads/' . $product->img)) {
//            unlink('uploads/' . $product->img);
//        }//un
//
//        if ($product->delete()) {
//            $product = new Session();
//            $product->setFlash('message', 'ลบผู้ใช้ เรียบรัอยแล้ว');
//
//            return $this->redirect(['product']);
//        }
//    }


    