<?php

use yii\grid\GridView;

$this->title = 'Yii2 Upload Tutorial';
?> 
<a href="index.php?r=upload/create" class="btn btn-success">
            <span class="glyphicon glyphicon-plus"></span>
            เพิ่มสินค้า
        </a>

<!--//GridView::widget([
//    'dataProvider' => $dataProvider,
//    'columns' => [
//        [            'class' => 'yii\grid\SerialColumn'        ],
//        'title',
//        'content',
//        'image',
//        'files', [            'class' => 'yii\grid\ActionColumn'        ]
//    ]
//])
//-->
 
<table style="margin-top: 10px" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th> ชื่อสินค้า </th>
                    <th> รายละเอียด </th>
                    <th>  ภาพ </th>
                    <th> file </th>
                    
                    <th width="110px">  </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($uploads as $upload): ?>
                    <tr>
                        <td><?php echo $upload->title; ?></td>
                        <td><?php echo $upload->content; ?></td>
                        <td><?php echo $upload->image; ?></td>
                        <td><?php echo $upload->files; ?></td>
                        
                        <td style="text-align: center">
                            <a href="index.php?r=upload/update&id=<?php echo $upload->id; ?>" class="btn btn-info">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                            <a href="index.php?r=upload/delete&id=<?php echo $upload->id; ?>" onclick="return confirm('ยืนยันการลบสินค้า')" class="btn btn-danger">
                                <span class="glyphicon glyphicon-remove"></span>
                            </a>
                        </td>
                    </tr> 
                <?php endforeach; ?>
            </tbody>
        </table>