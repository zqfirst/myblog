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
                    <a title="/" href="/blog/blog/detail?article_id=<?= $list->id ?>" class="readmore">阅读全文>></a>
                </ul>
                <p class="dateview"><span><?= $list->create_time ?></span><span>作者：dd</span><span>个人博客：[<a href="javascript:;"><?= isset( $list->category->name ) ? $list->category->name : '暂无分类' ?></a>]</span>
                </p>
				<?php
			endforeach;
		endif;
		?>
        <div class="page">
			<?= \yii\widgets\LinkPager::widget( [
				'pagination' => $pages,
			] ); ?>
        </div>
    </div>
    <aside class="right">
        <div class="weather">
            <iframe src="//www.seniverse.com/weather/weather.aspx?uid=U99359D647&cid=CHBJ000000&l=zh-CHS&p=SMART&a=0&u=C&s=3&m=0&x=1&d=0&fc=&bgc=&bc=&ti=0&in=0&li="  frameborder="0" scrolling="no" width="230" height="85" allowTransparency="true"></iframe>
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
                        <li><a href="/blog/blog/detail?article_id=<?= $list->id ?>"
                               title="<?= $list->title ?>"><?= $list->title ?></a></li>
					<?php endforeach; ?>
                </ul>
			<?php endif; ?>
            <!--            <h3 class="ph">-->
            <!--                <p>点击<span>排行</span></p>-->
            <!--            </h3>-->
            <!--            <ul class="paih">-->
            <!--                <li><a href="/" title="Column 三栏布局 个人网站模板" >Column 三栏布局 个人网站模板</a></li>-->
            <!--                <li><a href="/" title="withlove for you 个人网站模板" >with love for you 个人网站模板</a></li>-->
            <!--                <li><a href="/" title="免费收录网站搜索引擎登录口大全" >免费收录网站搜索引擎登录口大全</a></li>-->
            <!--                <li><a href="/" title="做网站到底需要什么?" >做网站到底需要什么?</a></li>-->
            <!--                <li><a href="/" title="企业做网站具体流程步骤" >企业做网站具体流程步骤</a></li>-->
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
</article>
