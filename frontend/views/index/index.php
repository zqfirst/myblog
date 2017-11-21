<?php
$this->title = "张强个人博客";
$this->registerCssFile( '/static/css/index.css' );
?>
<div class="banner">
    <section class="box">
        <ul class="texts">
            <p>打了死结的青春，捆死一颗苍白绝望的灵魂。</p>
            <p>为自己掘一个坟墓来葬心，红尘一梦，不再追寻。</p>
            <p>加了锁的青春，不会再因谁而推开心门。</p>
        </ul>
        <div class="avatar"><a href="#"><span>张强</span></a></div>
    </section>
</div>
<article>
    <h2 class="title_tj">
        <p>文章<span>推荐</span></p>
    </h2>
    <div class="bloglist left">
		<?php
		if( $articleList ):
			foreach ( $articleList as $list ):
				?>
                <h3><?= $list['title'] ?></h3>
				<?php
				if( isset( $list->category->url ) ) {
					echo "<figure><img src=\"{$list->category->url}\"></figure>";
				}
				?>
                <ul>
					<?= $list->decription ?>
                    <a title="/" href="/blog/blog/detail?article_id=<?= $list->id ?>" target="_blank" class="readmore">阅读全文>></a>
                </ul>
                <p class="dateview"><span><?=$list->create_time?></span><span>作者：dd</span><span>个人博客：[<a href="/news/life/"><?=isset($list->category->name)?$list->category->name:'暂无分类' ?></a>]</span>
                </p>
				<?php
			endforeach;
		endif;
		?>
        <div class="page">
		    <?=\yii\widgets\LinkPager::widget([
			    'pagination' => $pages,
		    ]);?>
        </div>
    </div>
    <aside class="right">
        <div class="weather">
            <iframe width="250" scrolling="no" height="60" frameborder="0" allowtransparency="true"
                    src="http://i.tianqi.com/index.php?c=code&id=12&icon=1&num=1"></iframe>
        </div>
        <div class="news">
			<?php
			if( isset( $newArticleList ) && is_array( $newArticleList ) ):
				?>
                <h3>
                    <p>最新<span>文章</span></p>
                </h3>
                <ul class="rank">
					<?php
					foreach ( $newArticleList as $list ):
						?>
                        <li><a href="/" title="<?=$list->title?>" target="_blank"><?=$list->title?></a></li>
					<?php endforeach; ?>
                </ul>
			<?php endif; ?>
            <!--            <h3 class="ph">-->
            <!--                <p>点击<span>排行</span></p>-->
            <!--            </h3>-->
            <!--            <ul class="paih">-->
            <!--                <li><a href="/" title="Column 三栏布局 个人网站模板" target="_blank">Column 三栏布局 个人网站模板</a></li>-->
            <!--                <li><a href="/" title="withlove for you 个人网站模板" target="_blank">with love for you 个人网站模板</a></li>-->
            <!--                <li><a href="/" title="免费收录网站搜索引擎登录口大全" target="_blank">免费收录网站搜索引擎登录口大全</a></li>-->
            <!--                <li><a href="/" title="做网站到底需要什么?" target="_blank">做网站到底需要什么?</a></li>-->
            <!--                <li><a href="/" title="企业做网站具体流程步骤" target="_blank">企业做网站具体流程步骤</a></li>-->
            <!--            </ul>-->
            <!--            <h3 class="links">-->
            <!--                <p>友情<span>链接</span></p>-->
            <!--            </h3>-->
            <!--            <ul class="website">-->
            <!--                <li><a href="/">个人博客</a></li>-->
            <!--                <li><a href="/">谢泽文个人博客</a></li>-->
            <!--                <li><a href="/">3DST技术网</a></li>-->
            <!--                <li><a href="/">思衡网络</a></li>-->
            <!--            </ul>-->
        </div>
        <!-- Baidu Button BEGIN -->
        <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a
                    class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span
                    class="bds_more"></span><a class="shareCount"></a></div>
        <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585"></script>
        <script type="text/javascript" id="bdshell_js"></script>
        <script type="text/javascript">
            document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date() / 3600000)
        </script>
        <!-- Baidu Button END -->
        <!--        <a href="/" class="weixin"> </a></aside>-->
</article>
