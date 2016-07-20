<?php

use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
?>

<div class="panel panel-primary">
    <div class="panel-heading">เพิ่ม/แก้ไข สินค้า</div>
    <div class="panel-body">
        <?php
        $f = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);
        echo $f->field($products, 'name');
        echo $f->field($products, 'detail')->widget(CKEditor::className(), [
            'options' => ['rows' => 6],
            //'preset' => 'basic'
        ]);
        echo $f->field($products, 'price_buy');
        echo $f->field($products, 'price_sale');
        echo $f->field($products, 'img')->fileInput();
        ?>

        <button class="btn btn-success">
            <span class="glyphicon glyphicon-ok"></span>
            บันทักข้อมูล
        </button> 

        <?php ActiveForm::end(); ?>

    </div>
</div>
