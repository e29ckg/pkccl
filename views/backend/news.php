<?php

use yii\web\Session;

$session = new Session();


?>

<div class="panel panel-primary">
    <div class="panel-heading">กระดานข่าว</div>
    <div class="panel-body">

        <?php if ($session->hasFlash('message')): ?>
            <div class="alert alert-danger">
                <span class="glyphicon glyphicon-remove"></span>
                <?php echo $session->hasFlash('message'). $session->getFlash('message'); ?>
            </div>
        <?php endif; ?>

        <a href="index.php?r=backend/newsform" class="btn btn-success">
            <span class="glyphicon glyphicon-plus"></span>
            เพิ่มข่าว
        </a>

        <table style="margin-top: 10px" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th> หัวข้อข่าว </th>
                    <th>  รายละเอียด</th>
                    <th> ภาพ </th>
                    
                    <th width="110px">  </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($news as $new): ?>
                    <tr>
                        <td><?php echo $new->h_news; ?></td>
                        <td><?php echo $new->detail; ?></td>
                        <td><?php echo $new->photo; ?></td>
                        
                        <td style="text-align: center">
                            <a href="index.php?r=backend/newsform&id=<?php echo $new->id; ?>" class="btn btn-info">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                            <a href="index.php?r=backend/newsdelete&id=<?php echo $new->id; ?>" onclick="return confirm('ยืนยันการลบสินค้า')" class="btn btn-danger">
                                <span class="glyphicon glyphicon-remove"></span>
                            </a>
                        </td>
                    </tr> 
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>