<?php

//หากมี fileInput form จะสร้าง enctype="multipart/form-data ให้อัตโนมัตินะ (v2.0.8) 

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?> 

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?> 
<?= $form->field($model, 'title')->textInput() ?> 
<?= $form->field($model, 'content')->textarea() ?> 
<img class="img-responsive" src="<?php
if ($model->image) {
    echo $model->getImage();
} else {
    echo $model->getImage() . 'nopic.png';
}
?>" alt="<?php echo $model->getImage() . 'nopic.png' ?>" height="100" width="100">

<?= $form->field($model, 'image')->fileInput() ?> 
<?= $form->field($model, 'files[]')->fileInput(['multiple' => true])//ต้องมี [] ด้วยนะเพราะหลายไฟล์เป็น array และมี multiple ด้วย 
?> 
<?php
if ($model->files) {
    foreach ($model->getFiles() as $key => $value) {
        ?>

        <img class="img-thumbnail" src="<?php echo $model->getFilesfolder() . $value; ?>" height="100" width="100">
        <a href="index.php?r=upload/deletefile&id=<?php echo $model->id . '&file=' . $value; ?>" onclick="return confirm('ยืนยันการลบ')" class="btn btn-danger">
            <span class="glyphicon glyphicon-remove"></span>
        </a>
        <br>
    <?php
    }
}
?>                        
<?= Html::submitButton('บันทึกข้อมูล', ['class' => 'btn btn-success']) ?> 
<?php ActiveForm::end() ?> 
