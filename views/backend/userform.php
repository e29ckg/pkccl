<?php

use yii\widgets\ActiveForm;
?>

<div class="panel panel-primary">
    <div class="panel-heading">เพิ่ม/แก้ไข ผู้ใช้ระบบ</div>
    <div class="panel-body">
        <?php
        $f = ActiveForm::begin();
        echo $f->field($user, 'name');
        echo $f->field($user, 'usr');
        echo $f->field($user, 'pwd')->passwordInput();
        echo $f->field($user, 'level')->radioList($user->level());
        ?>

        <button class="btn btn-success">
            บันทัก
        </button> 

<?php ActiveForm::end(); ?>

    </div>
</div>
