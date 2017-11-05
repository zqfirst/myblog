<?php
$this->title = $type == 'edit' ? "编辑分类" : "增加分类";
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
					<input type="hidden" name="id" value="<?= \common\libs\http\RequestHelper::get('id')?>">
					<input type="hidden" name="<?= Yii::$app->request->csrfParam ?>"
					       value="<?= Yii::$app->request->csrfToken ?>">
					<div class="row">
						<div class="form-group col-sm-6">
							<label for="function_id" class="control-label col-sm-3">所属分类</label>
							<div class="col-sm-6">
								<select id="function_id" class="form-control" name="parent_id">
									<option value="0">---顶级---</option>
									<?php foreach ( $firstCategoryList as $category ): ?>
										<option value="<?=$category['id']?>"
											<?php
											if($model && $category['id'] == $model->parent_id)
												echo 'selected';
											?>
										>
											<?php
											if($category['parent_id'] != 0)
												echo '-| &nbsp;';
											?>
                                            <?= $category['name'] ?>
										</option>
									<?php endforeach; ?>
								</select>
                            </div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-6">
							<label for="function_name" class="control-label col-sm-3">分类名称</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="function_name" name="name" value="<?=$model ? $model->name : ''?>"
								       placeholder="">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-6">
							<label for="Icon_Class" class="control-label col-sm-3">分类图标</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="Icon_Class" name="class" placeholder="" value="">
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
                        if(response.code == <?=\ResponseCode::SUCCESS_CODE ?>)
                        {
                            layer.closeAll('loading');
                            layer.msg(response.msg, {icon: 1});
                            location.href='/blog/category/index';
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
