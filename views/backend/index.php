<?php

use yii\widgets\ActiveForm;
use yii\web\Session;

$session = new Session();
?>

<div  class="panel panel-primary">
    <div class="panel-heading">Login to backend System</div>
    <div class="panel-body">

<?php if ($session->hasFlash('message')): ?>
            <div class="alert alert-danger">
                <span class="glyphicon glyphicon-remove"></span>
            <?php echo $session->getFlash('message'); ?>
            </div>
        <?php endif; ?>

        <?php
        $f = ActiveForm::begin();
        echo $f->field($user, 'usr');
        echo $f->field($user, 'pwd')->passwordInput();
        ?>

        <button class="btn btn-success">
            <span class="glyphicon glyphicon-ok">  </span>
            Login Now
        </button>
<?php ActiveForm::end(); ?>
    </div>
</div>
