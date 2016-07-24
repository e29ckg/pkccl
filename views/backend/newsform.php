<?php

use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
?>

<div class="panel panel-primary">
    <div class="panel-heading">เพิ่ม/แก้ไข ข่าว</div>
    <div class="panel-body">
        <?php
        $f = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);
        echo $f->field($news, 'h_news');
        echo $f->field($news, 'detail')->widget(CKEditor::className(), [
            'options' => ['rows' => 6],
                //'preset' => 'basic'
        ]);
        ?>
        <img class="img-responsive" src="<?php if (empty($news->photo)) {
            echo $news->getImagenull();
        } else {
            echo $news->getImage();
        } ?>"  height="100" width="100">
<?php
echo $f->field($news, 'photo')->fileInput();
?>

        <button class="btn btn-success">
            <span class="glyphicon glyphicon-ok"></span>
            บันทักข้อมูล
        </button> 

<?php ActiveForm::end(); ?>

    </div>
</div>
