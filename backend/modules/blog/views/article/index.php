<?php
$this->title = '文章列表';
?>
<section class="content-header">
    <h1>
		<?= $this->title ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="javascript:;"><i class="fa"></i> 首页</a></li>
        <li class="active"><?= $this->title ?></li>
    </ol>
</section>
<section class="content">
    <p style="margin: 10px">
        <a href="<?= $addArticleUrl ?>">
            <button class="btn btn-primary col-lg-1">新增文章</button>
        </a>
    </p>
    <table class="table text-center">
        <tr>
            <th width="10%">序号</th>
            <th width="20%">标题</th>
            <th width="10%">分类</th>
            <th width="50%">简介</th>
            <th width="10%">操作</th>
        </tr>
		<?php if ( $articleList ):
			foreach ($articleList as $key=>$list):
        ?>
                <tr>
                    <td><?=$key + 1?></td>
                    <td><?=$list->title?></td>
                    <td><?=$list->category->name?></td>
                    <td><?=$list->decription?></td>
                    <td>
                        <a href="/blog/article/edit-article?type=edit&id=<?=$list->id?>">编辑</a> | <a href="">删除</a>
                    </td>
                </tr>
        <?php
			endforeach;
		endif;
		?>
    </table>
</section>
