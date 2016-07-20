<?php

use yii\web\Session;

$session = new Session();


?>

<div class="panel panel-primary">
    <div class="panel-heading">สินค้าในระบบ</div>
    <div class="panel-body">

        <?php if ($session->hasFlash('message')): ?>
            <div class="alert alert-danger">
                <span class="glyphicon glyphicon-remove"></span>
                <?php echo $session->getFlash('message'); ?>
            </div>
        <?php endif; ?>

        <a href="index.php?r=backend/productform" class="btn btn-success">
            <span class="glyphicon glyphicon-plus"></span>
            เพิ่มสินค้า
        </a>

        <table style="margin-top: 10px" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th> ชื่อสินค้า </th>
                    <th> ภาพ </th>
                    <th> ราคาซื้อ </th>
                    <th> ราคาจำหน่าย </th>
                    <th> สถานะ </th>
                    <th> วันที่บันทึก </th>
                    <th width="110px">  </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?php echo $product->name; ?></td>
                        <td><?php echo $product->img; ?></td>
                        <td><?php echo $product->price_buy; ?></td>
                        <td><?php echo $product->price_sale; ?></td>
                        <td><?php echo $product->status; ?></td>
                        <td><?php echo $product->created_at; ?></td>
                        <td style="text-align: center">
                            <a href="index.php?r=backend/producteditform&id=<?php echo $product->id; ?>" class="btn btn-info">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                            <a href="index.php?r=backend/productdelete&id=<?php echo $product->id; ?>" onclick="return confirm('ยืนยันการลบสินค้า')" class="btn btn-danger">
                                <span class="glyphicon glyphicon-remove"></span>
                            </a>
                        </td>
                    </tr> 
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>