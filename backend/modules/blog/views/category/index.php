<?php

$this->title = "博客分类管理";

?>
<section class="content-header">
	<h1>
		<?=$this->title?>
	</h1>
	<ol class="breadcrumb">
		<li><a href="javascript:;"><i class="fa"></i> 首页</a></li>
		<li class="active"><?=$this->title?></li>
	</ol>
</section>
<section class="content">
	<p style="margin: 10px">
		<a href="<?=$addCategoryUrl?>"><button class="btn btn-primary col-lg-1">新增分类</button></a>
	</p>
	<table class="table text-left">
		<tr>
			<th width="10%">序号</th>
			<th width="60%">分类名称</th>
            <th width="10%">操作</th>
		</tr>
		<?php foreach ($categoryList as $key => $list):?>
			<tr>
				<td><?=$key + 1?></td>
				<td <?=$list->parent_id == 0?:'style="padding-left:50px"';?>><?=$list->name?></td>
				<td>
                    <a href="/blog/category/edit?type=edit&id=<?=$list->id?>">编辑</a>
                    &nbsp;
                    <a href="javascript:;" data-id='<?=$list->id?>' class="delete-category">删除</a>
                </td>
			</tr>
		<?php endforeach;?>
	</table>
</section>
<script>
    $(function () {
        $('.delete-category').on('click',function () {
            var id = $(this).attr('data-id');
            layer.open({
                content: '确认删除？'
                ,btn: ['确认', '取消']
                ,btn1: function(index, layero){
                    var url ='/blog/category/delete?id='+id;
                    $.get(url,'',function (response) {
                        if(response.code == <?=\ResponseCode::SUCCESS_CODE ?>)
                        {
                            layer.closeAll('loading');
                            layer.msg(response.msg, {icon: 1});
                            location.href='/blog/category/index';
                        } else {
                            layer.msg(response.msg, {icon: 2});
                        }
                    });
                }
            });
            return '';

        })
    })
</script>