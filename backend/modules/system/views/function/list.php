<?php
    $this->title = "功能管理";
?>
<section class="content-header">
    <h1>
        功能管理
        <small>Function</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="javascript:;"><i class="fa"></i> 首页</a></li>
        <li class="active">function</li>
    </ol>
</section>
<section class="content">
    <p style="margin: 10px">
        <a href="<?=$addFunctionUrl?>"><button class="btn btn-primary col-lg-1">新增功能</button></a>
    </p>
    <table class="table text-center">
        <tr>
            <th width="10%">序号</th>
            <th width="15%">方法名</th>
            <th width="10%">跳转地址</th>
            <th width="10%">是否有效</th>
            <th width="10%">类型</th>
            <th width="15%">属性</th>
            <th width="10%">操作</th>
        </tr>
        <?php foreach ($functionList as $key => $list):?>
            <tr>
                <td><?=$key?></td>
                <td <?=$list->parent_id == 0?:'style="padding-left:50px"';?>><?=$list->name?></td>
                <td><?=$list->redirect_url?></td>
                <td><?=$list->validName?></td>
                <td><?=$list->typeName?></td>
                <td><?=$list->class?></td>
                <td><a href="/system/function/add-function?type=edit&id=<?=$list->id?>">编辑</a></td>
            </tr>
        <?php endforeach;?>
    </table>
</section>
