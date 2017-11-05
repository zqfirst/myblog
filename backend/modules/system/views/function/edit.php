<?php
$this->title = $type == 'edit' ? "编辑功能" : "增加功能";
$this->registerCssFile( '/public/plugins/iCheck/all.css' );
$this->registerCssFile( '/public/plugins/datepicker/datepicker3.css' );
$this->registerCssFile( '/public/plugins/colorpicker/bootstrap-colorpicker.min.css' );
$this->registerCssFile( '/public/plugins/timepicker/bootstrap-timepicker.min.css' );
?>
<section class="content-header">
    <h1>
		<?= $this->title; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $constUrlArray['backendIndex'] ?>"><i class="fa fa-user"></i>首页</a></li>
        <li class="active"><?= $this->title; ?></li>
</section>
<section class="content">
    <div class="box-body">
        <div class="row">
            <form class="form-horizontal" id="edit-function">
                <div class="box-body">
                    <input type="hidden" name="function_id" value="<?= \common\libs\http\RequestHelper::get('id')?>">
                    <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>"
                           value="<?= Yii::$app->request->csrfToken ?>">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="function_id" class="control-label col-sm-3">所属功能</label>
                            <div class="col-sm-6">
                                <select id="function_id" class="form-control" name="parent_id">
                                    <option value="0">---顶级---</option>
									<?php foreach ( $functions as $function ): ?>
                                        <option value="<?=$function['id']?>"
                                            <?php
                                                if($model && $function['id'] == $model->parent_id)
                                                  echo 'selected';
                                            ?>
                                        >
                                            <?= $function['name'] ?>
                                        </option>
									<?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="function_name" class="control-label col-sm-3">功能名称</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="function_name" name="name" value="<?=$model ? $model->name : ''?>"
                                       placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="route" class="control-label col-sm-3">功能方法</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="route" name="route" value="<?=$model ? $model->route : ''?>" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="redirect_url" class="control-label col-sm-3">跳转URL</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="redirect_url" name="redirect_url" placeholder="" value="<?=$model ? $model->redirect_url : ''?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="Icon_Class" class="control-label col-sm-3">属性图标</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="Icon_Class" name="class" placeholder="" value="<?=$model ? $model->class : ''?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="Icon_Class" class="control-label col-sm-3">功能选择</label>
                            <div class="col-sm-6">
                                <label class="checkbox-inline">
                                    <input type="radio" name="type" value="2" <?php if(!$model || $model->type == \backend\modules\system\models\SysFunction::MENU) echo 'checked';?>>菜单点
                                </label>
                                <label class="checkbox-inline">
                                    <input type="radio" name="type" value="1" <?php if($model && $model->type == \backend\modules\system\models\SysFunction::FUNC) echo 'checked';?>> 功能点
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="Icon_Class" class="control-label col-sm-3">是否有效</label>
                            <div class="col-sm-6">
                                <label class="checkbox-inline">
                                    <input type="radio" name="is_valid" value="1" <?php if(!$model || $model->is_valid == \backend\modules\system\models\SysFunction::VALID) echo 'checked';?>>有效
                                </label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <label class="checkbox-inline">
                                    <input type="radio" name="is_valid" value="0" <?php if($model && $model->is_valid == \backend\modules\system\models\SysFunction::NOT_VALID) echo 'checked';?>>无效
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-2">
                            <button type="button" id="form-submit" class="btn btn-primary">保存</button>
                            <button type="reset" class="btn btn-default">重置</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(function () {
            $('#form-submit').on('click', function () {
                var info = $('#edit-function').serialize();
                $.post({
                    'url' : "",
                    'type' : 'post',
                    'data':info,
                    'dataType':'json',
                    'success':function (response) {
                        console.log(response);
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
</section>
