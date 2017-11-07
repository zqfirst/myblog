<?php
    use frontend\assets\AppAsset;
    AppAsset::register($this);
    $this->registerCssFile('/static/css/main.css');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <title><?=isset($this->title)?$this->title:''?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>
    <?php if($this->context->hasTop):?>
    <header>
<!--        <div id="logo"><a href="/"></a></div>-->
        <div id="logo"><a href="/"></a></div>
        <nav class="topnav" id="topnav">
            <a href="/"><span>首页</span><span class="en">Protal</span></a>
            <a href="/blog/blog/index"><span>博客</span><span class="en">blog</span></a>
            <a href="/life/life/say"><span>碎言碎语</span><span class="en">Doing</span></a>
<!--            <a href="share.html"><span>模板分享</span><span class="en">Share</span></a>-->
<!--            <a href="/technology/tech"><span>学无止境</span><span class="en">Learn</span></a>-->
<!--            <a href="/words/words/words-list"><span>留言版</span><span class="en">Gustbook</span></a>-->
            <a href="/life/about-me"><span>关于我</span><span class="en">About</span></a>
        </nav>
    </header>
    <?php endif;?>
    <?php if($this->context->hasNav):?>
    <article>
        <h1 class="t_nav"><span><?=$this->context->words?></span><a href="/" class="n1">网站首页</a><a href="javascript:;" class="n2"><?=$this->context->title?></a></h1>
    </article>
    <?php endif;?>
    <?= $content ?>
    <?php if($this->context->hasFoot):?>
    <footer>
        <p>Design by DanceSmile <a href="http://www.miitbeian.gov.cn/" target="_blank">蜀ICP备11002373号-1</a> <a href="/">网站统计</a></p>
    </footer>
    <?php endif;?>
    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>