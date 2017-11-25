<?php
$this->title = '用户列表';
?>
<section class="content-header">
    <h1>
        User List
        <small>Preview sample</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-user"></i> Home</a></li>
        <li><a href="#">list</a></li>
</section>
<section class="content">
    <p style="margin: 10px">
        <a href="<?=$addUserUrl?>"><button class="btn btn-primary col-lg-1">新增用户</button></a>
    </p>
    <table class="table text-center">
        <tr>
            <th>序号</th>
            <th>用户名</th>
            <th>手机号</th>
            <th>状态</th>
            <th>注册时间</th>
            <th>操作</th>
        </tr>
        <?php foreach ($userList as $key=>$list):?>
        <tr>
            <td><?=$key+1?></td>
            <td><?=$list->username?></td>
            <td><?=$list->phone?></td>
            <td><?=$list->statusName?></td>
            <td><?=$list->create_time?></td>
            <td><a href="/system/user/add-user?type=edit&id=<?=$list->id?>">编辑</a></td>
        </tr>
        <?php endforeach;?>
    </table>
</section>
