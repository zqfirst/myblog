<?php
$this->registerCssFile( '/static/css/teacDetail.css?v=1' );
?>
<div class="index_about">
    <div class="articleDetail">
        <h2 class="c_titile">【<?= isset( $articleModle->category->name ) ? $articleModle->category->name : '' ?>
            】<?= $articleModle->title ?></h2>
        <p class="box_c">
            <span class="d_time">发布时间：<?= substr( $articleModle->create_time, 0, 10 ) ?></span>
            <span>编辑：<a href="javascript:;">张强</a></span>
            <!--        <span>阅读（<script src="/e/public/ViewClick/?classid=3&amp;id=741&amp;addclick=1"></script>6406）</span>-->
        </p>
        <ul class="infos">
            <?= $articleModle->articleExtend->content ?>
        </ul>
    </div>
    <div class="keybq">
        <p><span>关键字词</span>：<?= $articleModle->keywords ?></p>
    </div>

    <!--    <div class="nextinfo">-->
    <!--        <p>上一篇：<a href="/e/action/ShowInfo.php?classid=3&amp;id=690">伪球迷看世界杯</a></p>-->
    <!--        <p>下一篇：<a href="/e/action/ListInfo/?classid=3">返回列表</a></p>-->
    <!--    </div>-->
    <div class="blank"></div>

</div>
