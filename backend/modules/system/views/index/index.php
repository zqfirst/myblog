<?php
$this->title = '测试';
?>
<section class="content-header">
    <h1>
        Server Detail
        <small>detail</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="javascript:;"><i class="fa fa-dashboard"></i> Index</a></li>
        <li class="active">index</li>
    </ol>
</section>
<section class="content">
    <p>
        system : <?= php_uname();?>
    </p>
    <p>
        php-version : <?= phpversion() ;?>
    </p>
</section>