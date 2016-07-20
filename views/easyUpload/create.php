<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Easyupload */

$this->title = 'Create Easyupload';
$this->params['breadcrumbs'][] = ['label' => 'Easyuploads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="easyupload-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
