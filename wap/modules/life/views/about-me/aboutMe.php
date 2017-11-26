<?php
    $this->title = '关于我';
?>
<article class="aboutcon">
    <div class="about left">
        <h2><?=isset($article) && $article ? $article->title : ''?></h2>
        <?=$article->articleExtend->content?>
    </div>
    <aside class="right">
        <div class="about_c">
            <p>网名：<span>Alt F4</span> | 蜗牛</p>
            <p>姓名：张强 </p>
            <p>生日：1991-02-22</p>
            <p>籍贯：河南省—三门峡市</p>
            <p>现居：北京市—昌平区</p>
            <p>技能：PHP、MySQL、Nginx、Ubuntu</p>
            <a target="_blank" href="http://mail.qq.com/cgi-bin/qm_share?t=qm_mailme&email=BTcwNTE1NTU9MDdFdHQrZmpo" style="text-decoration:none;"><img src="http://rescdn.qqmail.com/zh_CN/htmledition/images/function/qm_open/ico_mailme_22.png" alt="张强个人博客" /></a>
        </div>
    </aside>
</article>