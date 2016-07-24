<?php 
$this->title = 'Upload Single and Multiple files'; 
?> 
<h1><?php $this->title?></h1> 
        <?=$this->render('_form', [ 'upload' => $upload ])?> 
