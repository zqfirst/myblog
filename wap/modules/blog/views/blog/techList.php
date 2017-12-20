<?php
$this->title = '慢生活';
$this->registerCssFile( '/static/css/blogList.css' );
?>
<!--<div class="rnav">-->
<!--    <ul>-->
<!--        <li class="rnav1"><a href="/news/s/" target="_blank">日记</a></li>-->
<!--        <li class="rnav2"><a href="/news/read/" target="_blank">欣赏</a></li>-->
<!--        <li class="rnav3"><a href="/news/life/" target="_blank">程序人生</a></li>-->
<!--        <li class="rnav4"><a href="/news/humor/" target="_blank">经典语录</a></li>-->
<!--    </ul>-->
<!--</div>-->
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