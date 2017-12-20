<?php
$this->registerCssFile( '/static/css/index.css?v=1.1' );
?>

<h2 class="title_tj">
    <p>文章<span>推荐</span></p>
</h2>
<div class="bloglist">
    <?php
        if( isset( $articleList ) && is_array( $articleList ) ):
            foreach ( $articleList as $list ):
    ?>
    <h3><a href="javascript:;"><?=$list->title?></a></h3>
    <?php
        if( isset( $list->category->url ) ) {
            echo "<figure><img src=\"{$list->category->url}\"></figure>";
        }
    ?>
    <ul>
        <?= $list->decription ?>
    </ul>
    <p class="readmore">
        <a href="/blog/blog/detail?article_id=<?= $list->id ?>" class="readmore">阅读全文&gt;&gt;</a>
    </p>
    <p class="dateview">
        <span>发表时间：</span><span><?= substr($list->create_time,0,10) ?></span><span>作者：张强</span><span>分类：[<a href="/"><?= isset( $list->category->name ) ? $list->category->name : '暂无分类' ?></a>]</span>
    </p>
    <?php
            endforeach;
        endif;
    ?>
</div>