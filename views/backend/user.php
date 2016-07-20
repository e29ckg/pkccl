<?php

use yii\web\Session;

$session = new Session();
?>

<div class="panel panel-primary">
    <div class="panel-heading">จัดการผู้ใช้ระบบ</div>
    <div class="panel-body">
        
        <?php if ($session->hasFlash('message')): ?>
            <div class="alert alert-danger">
                <span class="glyphicon glyphicon-remove"></span>
                <?php echo $session->getFlash('message'); ?>
            </div>
        <?php endif; ?>
        
        <a href="index.php?r=backend/userform" class="btn btn-success">
            <span class="glyphicon glyphicon-plus"></span>
            เพิ่มรายการ
        </a>

        <table style="margin-top: 10px" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th> ชื่อ </th>
                    <th> user </th>
                    <th> level </th>
                    <th> status </th>
                    <th width="110px">  </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $user->name; ?></td>
                        <td><?php echo $user->usr; ?></td>
                        <td><?php echo $user->level; ?></td>
                        <td><?php echo $user->status; ?></td>
                        <td style="text-align: center">
                            <a href="index.php?r=backend/userform&id=<?php echo $user->id; ?>" class="btn btn-info">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                            <a href="index.php?r=backend/userdelete&id=<?php echo $user->id; ?>" onclick="return confirm('ยืนยันการลบผู้ใช้')" class="btn btn-danger">
                                <span class="glyphicon glyphicon-remove"></span>
                            </a>
                        </td>
                    </tr> 
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

