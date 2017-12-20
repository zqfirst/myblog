<?php
$this->title =  $type == 'add' ? '新增用户' : '编辑用户';
$titleSimple = $type == 'add' ? 'User ADD' : 'User Edit';

?>
<section class="content-header">
    <h1>
        <?=$this->title;?>
        <small><?=$titleSimple;?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-user"></i>首页</a></li>
        <li class="active"><?=$this->title;?></li>
</section>
<section class="content">
    <div class="col-md-10">
        <!-- Horizontal Form -->
        <div class="box">
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" id="edit-user" method="post">
                <input type="hidden" name="<?=\Yii::$app->request->csrfParam?>" value="<?=\Yii::$app->request->csrfToken?>">
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputUsername" class="col-sm-2 control-label">用户名</label>
                        <div class="col-sm-10">
                            <input type="text" name="username" class="form-control" id="inputUsername" placeholder="username" value="<?=isset($user) && $user? $user->username : ''?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPhone" class="col-sm-2 control-label">手机号</label>

                        <div class="col-sm-10">
                            <input type="text" name="phone" class="form-control" id="inputPhone" placeholder="Phone" value="<?=isset($user) && $user? $user->phone : ''?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label">密码</label>

                        <div class="col-sm-10">
                            <input type="password" name="passwd" class="form-control" id="inputPassword" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword2" class="col-sm-2 control-label">重新输入密码</label>
                        <div class="col-sm-10">
                            <input type="password" name="passwd2" class="form-control" id="inputPassword2" placeholder="Password">
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <input type="hidden" name="user_id" value="<?=isset($user) && $user? $user->id : ''?>">
                    <button onclick="history.go(-1)" class="btn btn-default">取消</button>
                    <button type="button" id="form-submit" class="btn btn-primary pull-right">提交</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
</section>
<script>
    $(function () {
        $('#form-submit').on('click', function () {
            var info = $('#edit-user').serialize();
            $.ajax({
                'url' : "",
                'type' : 'post',
                'data':info,
                'dataType':'json',
                'success':function (response) {
                    if(response.code == <?=\ResponseCode::SUCCESS_CODE ?>)
                    {
                        layer.closeAll('loading');
                        layer.msg(response.msg, {icon: 1});
                        location.href='/system/function/index';
                    } else {
                        layer.msg(response.msg, {icon: 2});
                    }

                },
                'error':function (error) {

                }
            })
        })
    })
</script>
