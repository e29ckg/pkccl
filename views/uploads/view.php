<?php

use yii\widgets\DetailView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $model->title;
?> 
<h1><?= $this->title ?></h1> 
<?=
DetailView::widget([
    'model' => $model,
    'attributes' => [
        'content:html', [
            'attribute' => 'image',
            'format' => 'raw',
            'value' => $model->image ? Html::img(
                            $model->getImage(), [ 'class' => 'img-responsive']) : null], [ 'attribute' => 'files', 'format' => 'raw', 'value' => call_user_func(function($data) {
                        $files = null;
                        if ($data->files) {
                            foreach ($data->getFiles() as $key => $value) {
                                $files .= Html::a('<i class="glyphicon glyphicon-trash"></i>', ['delete-file', 'id' => $data->id, 'file' => $value], ['class' => 'btn btn-xs btn-danger', 'data' => ['confirm' => 'แน่ใจนะว่าต้องการลบ?', 'method' => 'post']]) . ' ' . Html::a($value, Url::to(Yii::getAlias('@web') . '/' . $data->uploadFilesFolder . '/' . $value), ['target' => '_blank']) . '<br />';
                            } return $files;
                        } else {
                            return null;
                        }
                    }, $model),]]])
        ?> 