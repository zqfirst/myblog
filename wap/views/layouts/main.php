<?php
    use frontend\assets\AppAsset;
    AppAsset::register($this);
    $this->registerCssFile('/static/css/main.css?v=1.1');
    $this->registerJsFile('/static/js/modernizr.js');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="format-detection" content="telephone=no">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
        <title><?=isset($this->title)?$this->title:'张强个人博客'?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>
    <?php if($this->context->hasTop):?>
    <header>
        <header>
            <div class="logo"><a href="/">张强个人博客</a></div>
            <div class="menu">
                <ul>
                    <li><a href="/">首页</a></li>
                    <li><a href="/blog/blog/index">博客</a></li>
                    <li><a href="/words/words/words-list">闲言碎语</a></li>
                    <li><a href="/life/about-me/index">关于我</a></li>
                </ul>
            </div>
        </header>
    </header>
    <?php endif;?>
    <?= $content ?>
    <?php if($this->context->hasFoot):?>
    <footer>
        <p><a href="http://www.yangqq.com">Design by DanceSmile</a> <a href="http://www.miitbeian.gov.cn/" target="_blank">京ICP备15064819号</a></p>
    </footer>
    <?php endif;?>
    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
